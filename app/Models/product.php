<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'store_id',
        'category_id',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault('No category');
    }
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    public function scopeFilter($query, $filters)
    {
        return $query->when($filters['name'] ?? null, function ($query, $name) {
            $query->where('name', 'like', '%' . $name . '%');
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        })->when($filters['store_id'] ?? null, function ($query, $storeId) {
            $query->where('store_id', $storeId);
        });
    }
    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }
    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }
    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }
    public function getRatingAttribute($value)
    {
        return $value ?? 0;
    }
    public function getFeaturedAttribute($value)
    {
        return $value ?? 0;
    }
    public function getStatusAttribute($value)
    {
        return $value ?? 'draft';
    }

    public function getImageUrlAttribute($value)
    {
        return $value ?  $value : 'dist/img/default-150x150.png';
    }
    public function getComparePriceAttribute($value)
    {
        return $value ?? $this->price;
    }
    public function getRatingStarsAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }
    public function getSalePersentAttribute()
    {
        if ($this->compare_price) {
            return round((($this->price - $this->compare_price) / $this->price) * 100);
        } else {
            return 0;
        }
    }
}
