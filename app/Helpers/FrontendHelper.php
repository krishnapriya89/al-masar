<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use App\Models\Provider;
use Illuminate\Support\Facades\Log;

class FrontendHelper
{
    /**
     * get provider
     *
     *
     */
    public static function getProvider($name, $key)
    {
        $value = null;

        $providerData = Provider::where('name', $name)
            ->with(['singleProviderDetail' => function ($query) use ($key) {
                $query->where('key', $key);
            }])
            ->first();

        if ($providerData && $providerData->singleProviderDetail) {
            $value = $providerData->singleProviderDetail->value;
        }

        return $value;
    }

    /**
     * Send Message to provided phone number
     *
     *
     */
    public static function sendMessage($phone, $message) {
        if(!$phone)
            return false;

        $phone_verification_code = mt_rand(1000, 9999);
        return $phone_verification_code;
        $getSmsSendApiUrl = FrontendHelper::getProvider('SMS API', 'sms_send_api_url');
        $apiKey = FrontendHelper::getProvider('SMS API', 'api_key');
        $type = 'text'; //set unicode while sending arabic messages
        $senderId = FrontendHelper::getProvider('SMS API', 'main_sender_id');
        $message .= $phone_verification_code;
        $arr = ['{api_key}', '{type}', '{phone_number}', '{sender_id}', '{message}'];
        $replace_arr = [$apiKey, $type, $phone, $senderId, $message];
        $url = str_replace($arr, $replace_arr, $getSmsSendApiUrl);

        Log::info(json_encode($url));

        //client declaration
        $client = new Client();
        $response = $client->get($url);

        //get the response data in json format
        $body = $response->getBody()->getContents();

        Log::info($body);

        $response_data = json_decode($body);
        Log::info($response_data);
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
