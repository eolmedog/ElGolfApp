<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VirtualPosController extends Controller
{


    public function create_payment(Request $request) {
                $request->validate([
                    'hours' => 'required|integer|min:1',
                    'email' => 'required|email'
                ]);
                $endpoint ="https://api.virtualpos.cl/v3/payment/request";
               
                $api_key = getenv('VIRTUALPOS_API_KEY');
                $secret_key = getenv('VIRTUALPOS_SECRET_KEY');
                
                $PRICE_PER_HOUR_PRESENCIAL= 32000;
                $PRICE_PER_HOUR_ONLINE= 30000;
                $OFERTA =false; //20% descuento


                $hours = $request->input('hours');
                $amount = $hours * $PRICE_PER_HOUR_PRESENCIAL;
                $social_id='12312312-3';
                $phone='56987654321';
                $email = $request->input('email');
                $first_name = $request->input('first_name');
                $last_name = $request->input('last_name');
                $description = urlencode('Pago de x horas a Centro El Golf');
                $url_retorno =  base64_encode("https://example.com/pago-confirmado");
                $callback_url =  base64_encode("https://example.com/pago-confirmado1");
                $payment=PaymentModel::create([
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'amount' => $amount,
                    'social_id' => $social_id,
                    'description' => $description,
                    'hours' => $hours,
                    'payment_status' => 'pending',
                    'merchant_internal_code' => 'OC_TEST',
                    'merchant_internal_channel'=>'portal_pagos',
                ]);
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
                            
                        $token_payload['amount' ] = $amount;
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
