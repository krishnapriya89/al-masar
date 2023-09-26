<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HowToBuy extends Model
{
    use HasFactory,ImageTrait;

    protected $imageDirectory = 'how-to-buy';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    // public function getImageValueAttribute()
    // {
    //     if($this->image	 && Storage::disk('public')->exists($this->image	))
    //         return Storage::url($this->image	);
    //     else
    //         return asset('frontend/images/default-img.png');
    // }

}
