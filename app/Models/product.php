<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(ProductObserver::class)]
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
        'quantity',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'image',
    ];
    protected $appends = ['image_url'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault('No category');
    }
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    public function scopeFilter(Builder $builder, array $filters)
    {
        $options = [
            'search', 'category', 'store', 'min_price', 'max_price', 'sort', 'order'
        ];
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
        if($this->image){
            return asset('storage/' . $this->image);
        }
        return $this->image ? asset('storage/' . $this->image) : 'https://via.placeholder.com/150';
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
