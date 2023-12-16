<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        $cliente1=Cliente::create([
            'email'=>'eolmedogonzalez@gmail.com',
            'first_name'=>'Enrique',
            'last_name'=>'Olmedo',
        ]);
        #associate this cliente with a plan
        $plan=Plan::where('name','Presencial')->first();
        $cliente1->plan()->associate($plan);
        $cliente1->save();
        $cliente2=Cliente::create([
            'email'=>'enrique@automatizalofome.cl',
            'first_name'=>'Andres',
            'last_name'=>'Gonzalez',
            'oferta' => true,
            ]);
        $plan2=Plan::where('name','Online')->first();
        $cliente2->plan()->associate($plan2);
        $cliente2->save();
        
    }
}
