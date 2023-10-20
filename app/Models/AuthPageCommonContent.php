<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthPageCommonContent extends Model
{
    use HasFactory, ImageTrait;

    protected $imageDirectory = 'auth-pages';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function scopePage($query, $page){
        return $query->where('page', $page);
    }
}
