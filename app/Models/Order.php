<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'status',
        'shipping_address',
        'billing_address',
        'credit_card_type',
        'credit_card_last_four',
        'customer_note',
        'quantity',
        'total_amount',
    ];
}
