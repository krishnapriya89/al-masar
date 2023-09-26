<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhyChoose extends Model
{
    use HasFactory,ImageTrait;

    protected $imageDirectory = 'about-us';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
    // public function getSectionOneImageValueAttribute()
    // {
    //     if($this->section_one_image	 && Storage::disk('public')->exists($this->section_one_image	))
    //         return Storage::url($this->section_one_image	);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }
    // public function getSectionTwoImageValueAttribute()
    // {
    //     if($this->section_two_image	 && Storage::disk('public')->exists($this->section_two_image	))
    //         return Storage::url($this->section_two_image	);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }
    // public function getSectionThreeImageValueAttribute()
    // {
    //     if($this->section_three_image	 && Storage::disk('public')->exists($this->section_three_image	))
    //         return Storage::url($this->section_three_image	);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }

}
