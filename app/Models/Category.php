<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected $dates = ['deleted_at'];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeStatus( $status = 1){
        return $this->where('status', $status);
    }
    public function scopeInactive(){
        return $this->where('status', 0);
    }
    public function scopeFilter($query, array $filters){
        $query->when($filters['name'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        })->when($filters['status'] ?? false, function($query, $status){
            return $query->where('status', $status);
        });
    }
    public function products(): HasMany
    {
        return $this->hasMany(product::class);
    }
}
