<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;

class HowToBuy extends Model
{
    use HasFactory,ImageTrait;

    protected $imageDirectory = 'how-to-buy';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

}
