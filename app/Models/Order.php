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

    protected $appends = ['order_received_date'];

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
    public function billingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)->where('type', 1);
    }

    public function shippingAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class)->where('type', 2);
    }

    public function getOrderReceivedDateAttribute()
    {
        return $this->created_at ? date('d.m.Y', strtotime($this->created_at)) : '';
    }

    public function getConvertedGrandTotalAttribute()
    {
        return $this->currency_rate * $this->grand_total;
    }

    public function getConvertedSubTotalAttribute()
    {
        return $this->currency_rate * $this->sub_total;
    }
    public function getConvertedReceivedAmountAttribute()
    {
        return $this->currency_rate * $this->payment_received_amount;
    }
    public function getAmountToBePaidAttribute()
    {
        return ($this->currency_rate * $this->grand_total) - ($this->currency_rate * $this->payment_received_amount);
    }
    public function getConvertedAmountToBePaidAttribute()
    {
        return ($this->getAmountToBePaidAttribute());
    }
    public function getFullBillingAddressAttribute()
    {
        return $this->address_one . ', ' .($this->address_two ? $this->address_two . ', ' : '') .  $this->city . ', ' . $this->zip_code;
    }
    public function getFullShippingAddressAttribute()
    {
        return $this->address_one . ', ' .($this->address_two ? $this->address_two . ', ' : '') .  $this->city . ', ' . $this->zip_code;
    }

    public function getConvertedTotalPriceAttribute() {
        return $this->total_price * $this->currency_rate;
    }

    public function getConvertedTotalBidPriceAttribute() {
        return $this->total_bid_price * $this->currency_rate;
    }

    public function priceWithSymbol($price) {
        return $this->currency_symbol . $price;
    }

    public function getStatusClassAttribute()
    {
        $color =
            [
                '1' => 'clr2',
                '2' => 'clr4',
                '3' => 'clr3',
                '4' => 'clr3',
                '5' => 'clr1',
            ];
        return $color[$this->order_status_id];
    }
}
