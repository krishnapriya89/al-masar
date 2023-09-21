<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;

class Contact extends Model
{
    use HasFactory,ImageTrait;

    use HasFactory, ImageTrait;

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
}
