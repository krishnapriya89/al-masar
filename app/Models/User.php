<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ImageTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, ImageTrait, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $imageDirectory = 'user-attachment';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Delete orders and their details
            $user->pendingOrders()->each(function ($order) {
                $order->orderDetails()->each(function ($orderDetail) {
                    $orderDetail->orderProduct()->delete();
                    $orderDetail->delete();
                });
                $order->address()->delete();
                $order->delete();
            });

            // Delete quotations and their details
            $user->notOrderedQuotations()->each(function ($quotation) {
                $quotation->quotationDetails()->delete();
                $quotation->delete();
            });

            // Delete otp tables
            $user->phoneOtps()->delete();
            $user->loginOtps()->delete();
            $user->emailVerify()->delete();
        });
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function phoneOtps()
    {
        return $this->hasMany(PhoneOtp::class);
    }

    public function loginOtps()
    {
        return $this->hasMany(LoginOtp::class);
    }

    public function profileOtps()
    {
        return $this->hasMany(ProfileOtp::class);
    }

    public function emailVerify()
    {
        return $this->hasMany(UserEmailVerify::class);
    }

    public function billingAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class)->where('type', 1)->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class)->where('type', 2)->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function getFullPhoneNumberAttribute() {
        return $this->phone_code . $this->phone;
    }

    public function getFullOfficePhoneNumberAttribute() {
        return $this->office_phone_code . $this->office_phone;
    }

    public function pendingOrders() {
        return $this->hasMany(Order::class)->where('order_status_id', 1);
    }

    public function notOrderedQuotations() {
        return $this->hasMany(Quotation::class)->where('status', '!=', 5);
    }
}
