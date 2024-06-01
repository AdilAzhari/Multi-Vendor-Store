<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'product_name',
    ];
    public $incrementing = true;
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => 'Product not available',
            'price' => 0,
        ]);
    }
    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault([

        ]);
    }
}
