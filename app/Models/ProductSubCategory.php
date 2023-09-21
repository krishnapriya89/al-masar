<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSubCategory extends Model
{
    use HasFactory, SoftDeletes, ImageTrait, Sluggable;

    protected $imageDirectory = 'product-sub-category';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=>true
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductMainCategory::class, 'product_main_category_id');
    }

    public function parent()
    {
        return $this->hasOne(ProductSubCategory::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductSubCategory::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tagged_sub_categories');
    }
}
