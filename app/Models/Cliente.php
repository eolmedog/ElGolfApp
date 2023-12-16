<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
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
}
