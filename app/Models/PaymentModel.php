<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory; use HasUuids;
    protected $table = 'payments';
    public $incrementing = false; // Indicates that the IDs are not auto-incrementing
    protected $keyType = 'string'; // Indicates the type of the primary key

    protected $fillable = [
        'amount',
        'description',
        'hours',
        'cliente_id',
        'payment_status',
        'payment_date',
        'payment_method',
        'payment_id',
        'invoice_or_receipt',
        'document_created',
        'hours_added'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
