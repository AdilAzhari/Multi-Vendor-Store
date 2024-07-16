<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'parent_id',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = ['image_url'];
    protected $dates = ['deleted_at'];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->attributes['image'] ? asset('storage/' . $this->attributes['image']) : null;
    }
    public function scopeActive()
    {
        return $this->where('status', 1);
    }
    public function scopeInactive()
    {
        return $this->where('status', 0);
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->when($filters['status'] ?? false, function ($query, $status) {
            return $query->where('status', $status);
        });
    }
    public function products(): HasMany
    {
        return $this->hasMany(product::class);
    }
}
