<?php

namespace App\Actions;

use App\Models\Cliente;
use App\Models\PaymentModel;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePaymentAction
{
    use AsAction;

    public function handle($email_cliente,$status='pending')
    {
        $cliente=Cliente::where('email',$email_cliente)->first();
        $cliente_id=$cliente->id;
        $new_payment=PaymentModel::create([
            'payment_status' => $status,
            'cliente_id' => $cliente_id
        ]);
        return $new_payment;
    }
}
