<?php

namespace App\Models;

use App\Helpers\AdminHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    use HasFactory;

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusClassAttribute()
    {
        $color =
            [
                '0' => 'clr4',
                '1' => 'clr2',
                '2' => 'clr3',
                '3' => 'clr1',
                '4' => 'clr5',
            ];
        return $color[$this->status];
    }

    public function getStatusValueAttribute()
    {
        $value =
            [
                '0' => 'Waiting for approval',
                '1' => 'Action From Vendor',
                '2' => 'Accepted',
                '3' => 'Rejected',
                '4' => 'Rejected by Vendor',
            ];
        return $value[$this->status];
    }

    public function getAdminStatusValueAttribute()
    {
        $value =
            [
                '0' => 'Waiting for approval',
                '1' => 'Action From Vendor',
                '2' => 'Order Waiting',
                '3' => 'Rejected by Admin',
                '4' => 'Rejected by Vendor',
            ];
        return $value[$this->status];
    }

    public function getConvertedPriceAttribute() {
        return $this->price * $this->quotation->currency_rate;
    }

    public function getConvertedBidPriceAttribute() {
        return $this->bid_price * $this->quotation->currency_rate;
    }

    public function getConvertedAdminApprovedPriceAttribute() {
        return $this->admin_approved_price * $this->quotation->currency_rate;
    }

    public function getConvertedProductTotalPriceAttribute() {
        return $this->total_price * $this->quotation->currency_rate;
    }

    public function getConvertedProductTotalBidPriceAttribute() {
        return $this->total_bid_price * $this->quotation->currency_rate;
    }

    public function priceWithSymbol($price) {
        return $this->quotation->currency_symbol . AdminHelper::getFormattedPrice($price);
    }
}
