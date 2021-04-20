<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'products_id',
        'order_amount',
        'order_ship_address',
        'customer_phone_number',
        'order_date',
        'order_tracking_number',
        'order_status',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Products(){
        return $this->belongsTo(Products::class);
    }
}
