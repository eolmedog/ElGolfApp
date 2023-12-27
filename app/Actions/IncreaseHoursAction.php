<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class IncreaseHoursAction
{
    use AsAction;

    public static function handle($email,$hours)
    {
        $client = new Client();
        $headers = [
        'Content-Type' => 'application/json',
        'X-API-KEY' => getenv('FN_API_KEY')
        ];

        $body = [
        "email" => $email,
        "hours" => $hours
        ];

       
        $res=$client->request('POST', 'https://us-central1-centro-el-golf.cloudfunctions.net/function-3', [
            'headers'=>$headers, 
            'json' => $body]);
        
        return $res;
    }
}
