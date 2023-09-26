<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;

class SiteCommonContent extends Model
{
    use HasFactory,ImageTrait;
    protected $imageDirectory = 'site-common-content';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }
}
