<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ImageTrait;

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
}
