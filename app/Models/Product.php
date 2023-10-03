<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, ImageTrait, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'base_price',
        'category',
        'sub_category',
        'stock',
        'status',
        'sort_order'
    ];

    protected $imageDirectory = 'product';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=>true
            ]
        ];
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function getDetailPageImageValueAttribute()
    {
        if($this->detail_page_image && Storage::disk('public')->exists($this->detail_page_image))
            return Storage::url($this->detail_page_image);
        else
            return asset('frontend/images/default-img.png');
    }

    public function gallery() {
        return $this->hasMany(ProductGallery::class);
    }
}
