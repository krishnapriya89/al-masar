<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function providerDetails()
    {
        return $this->hasMany(ProviderDetail::class);
    }

    public function singleProviderDetail()
    {
        return $this->hasOne(ProviderDetail::class)->latest();
    }
}
