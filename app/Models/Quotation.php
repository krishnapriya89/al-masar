<?php

namespace App\Models;

use App\Helpers\AdminHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $lastQuotation = self::latest()->first();
            $quotationNumber = $lastQuotation ? intval(substr($lastQuotation->uid, 4)) + 1 : 1;

            $quotation->uid = 'AMAS' . sprintf('%07d', $quotationNumber);
        });
    }

    protected $appends = ['quotation_received'];

    public function quotationDetails(): HasMany
    {
        return $this->hasMany(QuotationDetail::class);
    }

    //admin or user accepted quotations
    public function acceptedQuotationDetails(): HasMany
    {
        return $this->hasMany(QuotationDetail::class)->where('status', 2);
    }

    //not rejected quotations
    public function activeQuotationDetails(): HasMany
    {
        return $this->hasMany(QuotationDetail::class)->whereNotIn('status', [3,4]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function getQuotationReceivedAttribute()
    {
        return $this->created_at ? date('d.m.Y', strtotime($this->created_at)) : '';
    }

    public function getConvertedTotalPriceAttribute() {
        return $this->total_price * $this->currency_rate;
    }

    public function getConvertedTotalBidPriceAttribute() {
        return $this->total_bid_price * $this->currency_rate;
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

    public function priceWithSymbol($price) {
        return $this->currency_symbol . AdminHelper::getFormattedPrice($price);
    }
}
