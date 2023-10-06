<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory,SoftDeletes;

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getFullAddressAttribute()
    {
        return $this->address_one . ', ' .($this->address_two ? $this->address_two . ', ' : '') .  $this->city . ', ' . $this->zip_code;
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
