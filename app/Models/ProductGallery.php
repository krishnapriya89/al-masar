<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes, ImageTrait;

    protected $imageDirectory = 'product-gallery';

    public function getImageDirectory(){
        return $this->imageDirectory;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getImageValueAttribute()
    {
        if($this->file && Storage::disk('public')->exists($this->file))
            return Storage::url($this->file);
        else
            return asset('frontend/images/default-img.png');
    }

    public function getImageHrefValueAttribute()
    {
        if($this->file && Storage::disk('public')->exists($this->file))
            return $this->file;
        else
            return 'frontend/images/default-img.png';
    }

    public function getThumbImageValueAttribute()
    {
        if($this->thumb_image && Storage::disk('public')->exists($this->thumb_image))
            return Storage::url($this->thumb_image);
        else
            return asset('frontend/images/default-img.png');
    }

}
