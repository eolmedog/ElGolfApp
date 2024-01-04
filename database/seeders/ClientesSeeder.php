<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        $clientesData = [
            ['email' => 'makoto.takeuchi@mitsubishicorp.com', 'first_name' => 'Makoto', 'last_name' => 'Takeuchi'],
            ['email' => 'ishiguro.yasunar.yg8@jx-nmm.com', 'first_name' => 'Yasunari', 'last_name' => 'Ishiguro'],
            ['email' => 'hiroshi.morishita@lundinmining.com', 'first_name' => 'Hiroshi', 'last_name' => 'Morishita'],
            ['email' => 'yoshio.moriyama@lundinmining.com', 'first_name' => 'Yoshio', 'last_name' => 'Moriyama'],
            ['email' => 'sennobu@mmc.co.jp', 'first_name' => 'Sadanobu', 'last_name' => 'Senju'],
            ['email' => 'tosaku@mmc.co.jp', 'first_name' => 'Toshinori', 'last_name' => 'Sakurama'],
            ['email' => 's.saiki@mmc.co.jp', 'first_name' => 'Sohei', 'last_name' => 'Saiki'],
            ['email' => 'iharak@mmc.co.jp', 'first_name' => 'Ken', 'last_name' => 'Ihara'],
            ['email' => 'atokuda@pelambres.cl', 'first_name' => 'Atsuhiro', 'last_name' => 'Tokuda'],
            ['email' => 'sakas.0812@gmail.com', 'first_name' => 'Kasumi', 'last_name' => 'Ando'],
            ['email' => 'kuristina.0716@gmail.com', 'first_name' => 'Aone', 'last_name' => 'Morishita'],
            ['email' => 'yasuhiro.shinada@lundinmining.com', 'first_name' => 'Yasuhiro', 'last_name' => 'Shinada'],
            ['email' => 'yoko425takeuchi@yahoo.co.jp', 'first_name' => 'Sra.', 'last_name' => 'Takeuchi'],
            ['email' => 'kudo.hisashi.ei7@jx-nmm.com', 'first_name' => 'Hisashi', 'last_name' => 'Kudo'],
            ['email' => 'delgermaa.sambalkhundev@lundinmining.com', 'first_name' => 'Delgermaa', 'last_name' => 'Sambalkhundev'],
            ['email' => 'ryoya-morishita@outlook.jp', 'first_name' => 'Morishita-kun', 'last_name' => '(jr)'],
            ['email' => 'maekawa.kotaro.vq3@jx-nmm.com', 'first_name' => 'Kotaro', 'last_name' => 'Maekawa'],
            ['email' => 'KUDO-T@jpn.marubeni.com', 'first_name' => 'Tatsuda', 'last_name' => 'KUDO'],
            ['email' => 'kkoizumi@nipponchile.cl', 'first_name' => 'Kenta', 'last_name' => 'Koizumi'],
        ];
        
        foreach ($clientesData as $data) {
            $new_client=Cliente::create($data);
            $plan=Plan::where('name','Online')->first();
            $new_client->plan()->associate($plan);
            $new_client->save();
        }
        
        
    }
}
