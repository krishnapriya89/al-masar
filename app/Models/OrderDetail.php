<?php

namespace App\Models;

use App\Helpers\AdminHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function orderProduct()
    {
        return $this->hasOne(OrderProduct::class, 'order_detail_id');
    }

    public function getConvertedPriceAttribute() {
        return $this->price * $this->order->currency_rate;
    }

    public function getConvertedBidPriceAttribute() {
        return $this->bid_price * $this->order->currency_rate;
    }

    public function getConvertedAdminApprovedPriceAttribute() {
        return $this->admin_approved_price * $this->order->currency_rate;
    }

    public function getConvertedProductTotalPriceAttribute() {
        return $this->total * $this->order->currency_rate;
    }

    public function getConvertedProductTotalBidPriceAttribute() {
        return $this->total_bid_price * $this->order->currency_rate;
    }

    public function priceWithSymbol($price) {
        return $this->order->currency_symbol . AdminHelper::getFormattedPrice($price);
    }

    public function getStatusClassAttribute()
    {
        $color =
            [
                '1' => 'clr4',
                '2' => 'clr2',
                '3' => 'clr3',
                '4' => 'clr3',
                '5' => 'clr1',
            ];
            return $color[$this->order_status_id] ?? 'clr2';
    }
}
