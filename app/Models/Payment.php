<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory,SoftDeletes,ImageTrait;

    public function scopeActive()
    {
        return $this->where('status',1);


    }
    protected $imageDirectory = 'payment';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function getImageValueAttribute()
    {
        if($this->image && Storage::disk('public')->exists($this->image))
            return Storage::url($this->image);
        elseif($this->image && file_exists(public_path($this->image)))
            return asset($this->image);
        else
            return asset('frontend/images/default-img.png');
    }
}
