<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'payment_status',
        'payment_method',
        'store_id',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->using(OrderItem::class)
            ->withPivot([
                'quantity',
                'price',
                'product_name',
            ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
            'email' => 'Guest@gmail.com']);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public static function getNextOrderNumberAttribute()
    {
        $year = now()->format('Y');
        $number = Order::whereYear('created_at', $year)->max('number');
        if($number){
            return 'ORD-'.str_pad($number + 1, 5, '0', STR_PAD_LEFT);
        }
        return 'ORD-'.str_pad(1, 5, '0', STR_PAD_LEFT);
    }
    public function getPaymentStatusAttribute()
    {
        return ucfirst($this->payment_status);
    }
    public function getSubtotalAttribute()
    {
        return $this->items->sum(function (OrderItem $item) {
            return $item->price * $item->quantity;
        });
    }
    public function getShippingAttribute()
    {
        return 10;
    }
    public function getTotalAttribute()
    {
        return $this->subtotal + $this->shipping;
    }
    public function getPaymentMethodAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->payment));
    }
    public function address(){
        return $this->hasMany(OrderAddress::class);
    }
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'billing');
    }
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

}
