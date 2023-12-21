<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory; use HasUuids;
    protected $table='clientes';
    protected $fillable=[
        'email',
        'first_name',
        'last_name',
        'oferta'
    ];
    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function payments(){
        return $this->hasMany(PaymentModel::class);
    }
}
