<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
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

}
