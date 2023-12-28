<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use App\Jobs\IncreaseHoursJob;
use Illuminate\Support\Facades\Log;
use App\Actions\IncreaseHoursAction;

class PostPurchaseController extends Controller
{
   
    public function receive_payment(Request $request){
        $uuid=$request->input('uuid'); //uuid de virtualpos
        $payment_data=$this->get_payment_info($uuid);

        $payment_status=$payment_data->order->status;
        $internal_code=$payment_data->order->merchant_internal_code;
        if ($payment_status=='pagado'){
            $payment=PaymentModel::find($internal_code);
            $cliente_email=$payment->cliente->email;
            $hours=$payment->hours;
            $payment->update(['payment_status'=>'paid','payment_date'=>date('Y-m-d'),'payment_method'=>'virtualpos','payment_id'=>$uuid]);
            IncreaseHoursJob::dispatch($internal_code);
            Log::debug("message: Payment for internal_code $internal_code was successful");
            return view('post-compra', [
                'internal_code' => $internal_code
            ]);
        }
        else if ($payment_status=='rechazado'){
            $payment=PaymentModel::where('merchant_internal_code',$internal_code)->first();
            $payment->update(['payment_status'=>'declined','payment_method'=>'virtualpos','payment_id'=>$uuid]);
            return view('payment-declined', [
                'internal_code' => $internal_code,
                'reason' => 'declined'
            ]); 
        }

        else {
            $payment=PaymentModel::where('merchant_internal_code',$internal_code)->first();
            $payment->update(['payment_method'=>'virtualpos','payment_id'=>$uuid]);
            return view('payment-pending', [
                'internal_code' => $internal_code,
                'reason' => 'pending' 
            ]);
        }

    }
    public function process_payment(Request $request){
        #Para API
        $uuid=$request->input('uuid');
        $payment_data=$this->get_payment_info($uuid);
        $payment_status=$payment_data->order->status;
        $internal_code=$payment_data->order->merchant_internal_code;
        
        if ($payment_status=='pagado'){
            $payment=PaymentModel::find($internal_code);
            $cliente_email=$payment->cliente->email;
            $hours=$payment->hours;
            $payment->update(['payment_status'=>'paid','payment_date'=>date('Y-m-d H:i:s'),'payment_method'=>'virtualpos','payment_id'=>$uuid]);
            Log::debug("message: Process payment for internal_code was succesful $internal_code was successful");
            IncreaseHoursJob::dispatch($internal_code);
            return 200;
        }
        else if ($payment_status=='rechazado'){
            $payment=PaymentModel::where('merchant_internal_code',$internal_code)->first();
            $payment->update(['payment_status'=>'declined','payment_method'=>'virtualpos','payment_id'=>$uuid]);
            
            return 200;
        }

        else {
            $payment=PaymentModel::where('merchant_internal_code',$internal_code)->first();
            $payment->update(['payment_method'=>'virtualpos','payment_id'=>$uuid]);
            return 200;
        }
    }

    public function get_payment_info($uuid){
        $api_key=getenv('VIRTUALPOS_API_KEY');
        $secret_key=getenv('VIRTUALPOS_SECRET_KEY');
        $token_payload = array();
        $token_payload['api_key'] = $api_key;
        $signature = JWT::encode($token_payload, $secret_key,'HS256');
                
        $client = new Client([
                            'headers' => [ 'Content-Type' => 'application/json' , 'Authorization'=>$api_key, 'Signature' => $signature ]
                            ]);

        $response=$client->request('GET', getenv('URL').'/v3/payment/'.$uuid);
        $payment_data=json_decode($response->getBody()->getContents());
        $payment_data=$payment_data->payment;
        return $payment_data;

    }
}
