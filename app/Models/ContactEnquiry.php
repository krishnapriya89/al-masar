<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    use HasFactory;

    protected $appends = ['date_formatted'];

    public function getDateFormattedAttribute()
        {
             return date('M d,Y', strtotime($this->created_at));
        }
}
