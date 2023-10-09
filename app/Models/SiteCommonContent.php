<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteCommonContent extends Model
{
    use HasFactory,ImageTrait;
    protected $imageDirectory = 'site-common-content';

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function getConvertedPhoneNumberAttribute()
    {
        return str_replace(array( '(', ')' ), '', $this->phone);
    }
    protected function menuCategory(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode(',', $value),
            set: function ($value) {
                if (is_array($value)) {
                    return implode(',', $value);
                }
                return $value;
            }
        );
    }
}
