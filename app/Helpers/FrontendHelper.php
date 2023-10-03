<?php

namespace App\Helpers;

class FrontendHelper
{
    /**
     * get provider
     * 
     *
     */
    // public static function getProvider($name, $key)
    // {
    //     $value = null;

    //     $providerData = Provider::where('name', $name)
    //         ->with(['singleProviderDetail' => function ($query) use ($key) {
    //             $query->where('key', $key);
    //         }])
    //         ->first();

    //     if ($providerData && $providerData->singleProviderDetail) {
    //         $value = $providerData->singleProviderDetail->value;
    //     }

    //     return $value;
    // }

    /**
     * Send OTP to phone number
     * 
     *
     */
    public static function sendOtp($phone) {
        if(!$phone)
            return false;

        $phone_verification_code = mt_rand(1000, 9999);

        return $phone_verification_code;
    }

    /**
     * currency related functions
     * 
     *
     */
    public static function getCurrencyRate()
    {
        return session('currency_rate') ?? '1';
    }

    public static function getCurrencySymbol()
    {
        return session('currency_symbol') ?? '$';
    }

    public static function getCurrencyCode()
    {
        return session('currency_code') ?? 'USD';
    }

    public static function getCurrencyConvertedPrice($price)
    {
        return AdminHelper::getFormattedPrice(self::getCurrencyRate() * $price);
    }

    public static function getCurrencySymbolWithConvertedPrice($price)
    {
        return self::getCurrencySymbol() .  self::getCurrencyConvertedPrice($price);
    }
}