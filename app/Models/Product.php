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

    public function getListingImageValueAttribute()
    {
        if($this->listing_image && Storage::disk('public')->exists($this->listing_image))
            return Storage::url($this->listing_image);
        else
            return asset('frontend/images/default-img.png');
    }

    //return the discounted value if no discount then return the base price
    public function getPriceAttribute()
    {
        if ($this->discount_type != 0) {
            if($this->discount_type == 1)
                return $this->base_price - $this->discount;
            else
                return $this->base_price - (($this->base_price * $this->discount) / 100);
        }
        else
            return $this->base_price;
    }

    //return the product min price that is the min quantity * after offer price or the base price
    public function getMinProductPriceAttribute()
    {
        return (($this->min_quantity_to_buy ?? 1) * $this->getPriceAttribute());
    }

    public function getIsInstockAttribute()
    {
        if ($this->stock < 1 || $this->stock_status == 0)
            return 0;
        else
            return 1;
    }

    //used in product list page to blink the out of stock products
    public function getStockClassAttribute()
    {
        if (!$this->getIsInstockAttribute())
            return 'notfy';
        else
            return '';
    }

    public function gallery() {
        return $this->hasMany(ProductGallery::class);
    }
}
