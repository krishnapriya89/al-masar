<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminConfig extends Model
{
    protected $imageDirectory = 'config';

    use HasFactory, ImageTrait;

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
}
