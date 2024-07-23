<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'currency',
        'transaction_id',
        'transaction_data',
        'paid_at',
        'cancelled_at',
        'failed_at',
        'refunded_at',
    ];
    protected $casts = [
        'transaction_data' => 'array',
        'paid_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'failed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
