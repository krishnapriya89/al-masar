<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;

class WhyChoose extends Model
{
    use HasFactory,ImageTrait;

    protected $imageDirectory = 'about-us';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

}
