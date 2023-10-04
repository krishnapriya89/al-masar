<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeBanner extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;

    protected $imageDirectory = 'home-banners';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function getImageValueAttribute()
    {
        if($this->web_image && Storage::disk('public')->exists($this->web_image))
            return Storage::url($this->web_image);
        else
            return asset('frontend/images/default-img.png');
    }
}
