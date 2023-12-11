<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'amount',
        'social_id',
        'description',
        'hours',
        'payment_status',
        'payment_date',
        'payment_method',
        'payment_id',
        'payment_status'
    ];
}
