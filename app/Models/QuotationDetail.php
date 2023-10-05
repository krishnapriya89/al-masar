<?php

namespace App\Models;

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
                '1' => 'clr3',
                '3' => 'clr1',
            ];
        return $color[$this->status];
    }

    public function getStatusValueAttribute()
    {
        $value =
            [
                '0' => 'Waiting for approval',
                '1' => 'Action From Vendor',
                '1' => 'Accepted',
                '3' => 'Rejected',
            ];
        return $value[$this->status];
    }

    public function getConvertedBidPriceAttribute() {
        return $this->bid_price * $this->quotation->currency_rate;
    }

    public function getConvertedProductTotalPriceAttribute() {
        return $this->bid_price * $this->quantity * $this->quotation->currency_rate;
    }

    public function priceWithSymbol($price) {
        return $this->quotation->currency_symbol . $price;
    }
}
