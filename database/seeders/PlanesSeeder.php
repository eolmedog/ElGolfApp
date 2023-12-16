<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        Plan::Create([
            'name' => 'Presencial',
            'description' => 'Plan de pago presencial',
            'price' => 32000,
        ]);
        Plan::Create([
            'name' => 'Online',
            'description' => 'Plan de pago online',
            'price' => 30000,
        ]);
    }
}
