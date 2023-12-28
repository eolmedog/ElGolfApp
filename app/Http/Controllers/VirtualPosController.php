<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\Cliente;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VirtualPosController extends Controller
{


    public function create_payment(Request $request) {
                $request->validate([
                    'hours' => 'required|integer|min:1',
                    'email' => 'required|email',
                ]);

                $endpoint ="https://api.virtualpos.cl/v3/payment/request";
                if (getenv('VIRTUALPOS_ENV') == 'sandbox') {
                    $endpoint = "https://api.virtualpos-sandbox.com/v3/payment/request";
                }

                $api_key = getenv('VIRTUALPOS_API_KEY');
                $secret_key = getenv('VIRTUALPOS_SECRET_KEY');
                $payment=PaymentModel::find($request->input('internal_code'));
                if (!$payment) {
                    abort(404,'Payment object not found');
                }
                $cliente=$payment->cliente;
                $PRICE_PER_HOUR = Plan::max('price');
                # if $cliente doesn't exist, PRICE_PER_HOUR_PRESENCIAL equals to the maximum value of price in planes table:
                if($cliente){
                    $PRICE_PER_HOUR = $cliente->plan->price;
                    $PRICE_PER_HOUR = $PRICE_PER_HOUR * (1-.2*$cliente->oferta);
                }


                $hours = $request->input('hours');
                $amount = $hours * $PRICE_PER_HOUR;
                $social_id='5555555-5';
                $phone='56955555555';
                $email = $cliente->email;
                $first_name = $cliente->first_name;
                $last_name = $cliente->last_name;
                $description = urlencode('Pago de ' . $hours . ' horas a Centro El Golf');
                $url_retorno = base64_encode(getenv('APP_URL') . "/post-compra");
                $callback_url = base64_encode(getenv('APP_URL') . "/api/payment_webhook");
                $payment->amount=$amount;
                $payment->description=$description;
                $payment->hours=$hours;
                $payment->payment_status='pending';
                $payment->payment_method='Web App';
                $payment->save();
                $merchant_internal_code = $payment->id;
                
                $merchant_internal_channel = 'Web App';
                $token_payload = array();
                    
                $token_payload['amount' ] = $amount;
                $token_payload['email'] = $email;
                $token_payload['social_id'] = $social_id;
                $token_payload['first_name'] = $first_name;
                $token_payload['last_name'] = $last_name;
                $token_payload['phone'] = $phone;
                $token_payload['return_url'] = $url_retorno;
                $token_payload['merchant_internal_code'] = $merchant_internal_code;
                $token_payload['merchant_internal_channel'] = $merchant_internal_channel;
                $token_payload['payment_method']='all';
                $token_payload['description' ] = $description;
                $token_payload['callback_url'] = $callback_url;
                $signature = JWT::encode($token_payload, $secret_key,'HS256');
                
                $client = new Client([
                                    'headers' => [ 'Content-Type' => 'application/json' , 'Authorization'=>$api_key ]
                                    ]);
                $response = $client->post( $endpoint , [
                                            
                    'json' => [
                        'amount' => $amount,
                        'email' => $email,
                        'social_id' => $social_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'phone' => $phone,
                        'description' => $description,
                        'return_url' => $url_retorno,
                        'callback_url' => $callback_url,
                        'merchant_internal_code' => $merchant_internal_code,
                        'merchant_internal_channel' => $merchant_internal_channel,
                        'payment_method' => 'all',
                        'signature' => $signature,            
                            ]
                        ]);                    
                $response_decode = json_decode($response->getBody()->getContents());
                
                
               if($response_decode->code != 200){
                   return "error en el servicio : " . $response->getBody();
               }
                
                return redirect( $response_decode->url_redirect ); 
            }
            public function testAPIRequestPaymentV3(Request $request) {
                        $endpoint ="https://api.virtualpos.cl/v3/payment/request";
                       
                        $api_key = getenv('VIRTUALPOS_API_KEY');
                        $secret_key = getenv('VIRTUALPOS_SECRET_KEY');
                        
                        $amount = random_int(10, 99)*100;;
                        $email = 'johndoe@gmail.com';
                        $social_id = "12312312-3";
                        $first_name = "John";
                        $last_name = "Doe";
                        $phone = "56987654321";
                        $description = urlencode("Pago de Prueba");
                        $return_url = base64_encode("https://tu.url.de.retorno");
                        $callback_url =  base64_encode("https://tu.url.de.retorno.asincrono");
                        $merchant_internal_code = "123";
                        $merchant_internal_channel = "WEB";
                        $payment_method = "all";
                    
                        $token_payload = array();
                            
                        $token_payload['amount'] = $amount;
                        $token_payload['email'] = $email;
                        $token_payload['social_id'] = $social_id;
                        $token_payload['first_name'] = $first_name;
                        $token_payload['last_name'] = $last_name;
                        $token_payload['phone'] = $phone;
                        $token_payload['return_url'] = $return_url;
                        $token_payload['merchant_internal_code'] = $merchant_internal_code;
                        $token_payload['merchant_internal_channel'] = $merchant_internal_channel;
                        $token_payload['payment_method'] = $payment_method;
                        $token_payload['description' ] = $description;
                        $token_payload['callback_url'] = $callback_url;

                        $jwt = JWT::encode($token_payload, $secret_key,'HS256');
                        
                        $client = new Client([
                                            'headers' => [ 'Content-Type' => 'application/json' , 'Authorization'=>$api_key ]
                                            ]);
                        $response = $client->post( $endpoint , [
                                                    
                            'json' => [
                                'amount' => $amount,
                                'email' => $email,
                                'social_id' => $social_id,
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'phone' => $phone,
                                'description' => $description,
                                'return_url' => $return_url,
                                'callback_url' => $callback_url,
                                'merchant_internal_code' => $merchant_internal_code,
                                'merchant_internal_channel' => $merchant_internal_channel,
                                'payment_method' => $payment_method,
                                'signature' => $jwt,            
                                    ]
                                ]);                    
                    
                        $response_decode = json_decode($response->getBody()->getContents());
                        
                        
                       if($response_decode->code != 200){
                           return "error en el servicio : " . $response->getBody();
                       }
                        
                        dd($response_decode);
                        //return redirect( $response_decode->url_redirect );
                        
                           
                    }
}
