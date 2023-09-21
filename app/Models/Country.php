<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
