<?php

namespace App\Models;

use App\Helpers\AdminHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function getFullBillingAddressAttribute()
    {
        return $this->address_one . ', ' .($this->address_two ? $this->address_two . ', ' : '') .  $this->city . ', ' . $this->zip_code;
    }
    public function getFullShippingAddressAttribute()
    {
        return $this->address_one . ', ' .($this->address_two ? $this->address_two . ', ' : '') .  $this->city . ', ' . $this->zip_code;
    }
    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 1);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_id')->where('type', 2);
    }
}
