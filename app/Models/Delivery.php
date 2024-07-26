<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'lat',
        'lng',
        'tracking_number',
        'carrier',
        'status',
        'shipped_at',
        'delivered_at',
        'notes',
        'tracking_url',
        'tracking_url_provider',
    ];
    protected $appends = ['current_location'];
    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getCurrentLocationAttribute()
    {
        return [
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }

    public function setCurrentLocationAttribute($value)
    {
        $this->attributes['lat'] = $value['lat'];
        $this->attributes['lng'] = $value['lng'];
    }
}
