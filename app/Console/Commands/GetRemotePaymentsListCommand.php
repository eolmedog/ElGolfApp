<?php

namespace App\Console\Commands;

use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetRemotePaymentsListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-remote-payments-list-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $api_key=getenv('VIRTUALPOS_API_KEY');
        $secret_key=getenv('VIRTUALPOS_SECRET_KEY');

        $token_payload = array();
        $token_payload['merchant_internal_code'] = '9ad7ee21-6fec-4c01-9d0e-931fed80b7d';
        $token_payload['api_key'] = $api_key;
        $signature = JWT::encode($token_payload, $secret_key,'HS256');
                
        $client = new Client([
                            'headers' => [ 'Content-Type' => 'application/json' , 'Authorization'=>$api_key, 'Signature' => $signature ]
                            ]);
        $response = $client->request('GET', getenv('URL').'/v3/payments?merchant_internal_code=9ad7ee21-6fec-4c01-9d0e-931ffed80b7d',[
            $query=[
                // 'merchant_internal_code' => '9ad7ee21-6fec-4c01-9d0e-931ffed80b7d'
            ]
        ]);

        echo $response->getBody();
    }
}
