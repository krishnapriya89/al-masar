<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory,ImageTrait;

    protected $imageDirectory = 'about-us';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
    // public function getImageValueAttribute()
    // {
    //     $imagePath = $this->image;

    //     // Check if the image exists in the "public" disk.
    //     if (Storage::disk('public')->exists($imagePath)) {
    //         return asset('storage/' . $imagePath);
    //     }

    //     // Check if the image exists in the public directory.
    //     if (file_exists(public_path($imagePath))) {
    //         return asset($imagePath);
    //     }

    //     // If the image doesn't exist, return the default image.
    //     return asset('frontend/images/default-img.png');
    // }
    // public function getMissionImageValueAttribute()
    // {
    //     if($this->mission_bg_image && Storage::disk('public')->exists($this->mission_bg_image))
    //         return Storage::url($this->mission_bg_image);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }
    // public function getVisionImageValueAttribute()
    // {
    //     if($this->vision_bg_image	 && Storage::disk('public')->exists($this->vision_bg_image	))
    //         return Storage::url($this->vision_bg_image	);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }

}
