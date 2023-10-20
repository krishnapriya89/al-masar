<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthPageCommonContent extends Model
{
    use HasFactory, ImageTrait;

    protected $imageDirectory = 'auth-pages';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function scopePage($query, $page)
    {
        return $query->where('page', $page);
    }

    public function getImageValueAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image))
            return Storage::url($this->image);
        elseif (file_exists(public_path($this->image)))
            return asset($this->image);
        else
            return asset('frontend/images/default-img.png');
    }
}
