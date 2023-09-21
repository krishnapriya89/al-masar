<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
