<?php

namespace App\Models;

use App\Helpers\AdminHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderDetails():HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function getOrderReceivedDateAttribute()
    {
        return $this->created_at ? date('d.m.Y', strtotime($this->created_at)) : '';
    }

    public function getConvertedGrandTotalAttribute()
    {
        return AdminHelper::getFormattedPrice($this->currency_rate * $this->grand_total);
    }

    public function getConvertedSubTotalAttribute()
    {
        return AdminHelper::getFormattedPrice($this->currency_rate * $this->sub_total);
    }

}
