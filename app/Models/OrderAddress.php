<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    public $timestamp = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'street_address',
        'city',
        'postal_code',
        'state',
        'country',
        'order_id',
        'type',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function getFullAddressAttribute()
    {
        return "{$this->street_address}, {$this->city}, {$this->state}, {$this->postal_code}, {$this->country}";
    }
    public function getFullTypeAttribute()
    {
        return ucfirst($this->type);
    }
    public function getFullCountryAttribute()
    {
        return strtoupper($this->country);
    }
}
