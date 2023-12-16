<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $table='planes';
    protected $fillable=[
        'name',
        'description',
        'price',
    ];

    public function cliente(){
        return $this->hasMany(Cliente::class);
    }
}
