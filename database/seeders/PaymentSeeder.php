<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use App\Actions\CreatePaymentAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        $action=new CreatePaymentAction();
        //Get first cliente
        $firstCliente = Cliente::first();
        $payment1=$action->handle();
        $payment2=$action->handle('paid');
        $payment3=$action->handle('declined');
        // Associate $payment1 to $firstCliente
        $payment1->cliente()->associate($firstCliente);
        $payment1->save();
        $payment2->cliente()->associate($firstCliente);
        $payment2->save();
        $payment3->cliente()->associate($firstCliente);
        $payment3->save();

    }
}
