<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProviderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'key',
        'value',
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = Str::slug(strtolower($value), '_');
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = encrypt($value);
    }

    public function getValueAttribute($value)
    {
        return decrypt($value);
    }
}
