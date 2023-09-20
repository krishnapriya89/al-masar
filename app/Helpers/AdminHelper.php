<?php

namespace App\Helpers;

use App\Models\Provider;
use App\Models\AdminConfig;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminHelper
{
    /**
     * get value by key
     *
     * @author Suchtih
     */
    public static function getValueByKey($key)
    {
        $config = AdminConfig::where('key', $key)->first();

        return $config ? $config->value : null;
    }

    /**
     * unique slug generator
     *
     * @author Suchtih
     */
    public static function generateUniqueSlug($model, $title, $currentId = null)
    {
        $slug       = Str::slug($title);
        $counter    = 0;

        // Check if a model with the generated slug already exists
        $model = 'App\\Models\\'.$model;
        $slugExists = $model::where('slug', $slug)->where('id', '!=', $currentId)->exists();

        while ($slugExists) {
            $counter++;
            $newSlug    = $slug . '-' . $counter;
            $slugExists = $model::where('slug', $newSlug)->where('id', '!=', $currentId)->exists();
            $slug       = $newSlug;
        }

        return $slug;
    }

    public static function getFormattedPrice($price)
    {
//        $formattedPrice = $price == floor($price) ? number_format($price, 0) : number_format($price, 2);
        $formattedPrice = number_format($price, 2);

        return $formattedPrice;
    }

    public static function getUnformattedPrice($formattedPrice)
    {
        $unformattedPrice = str_replace(',', '', $formattedPrice);

        return floatval($unformattedPrice);
    }

    /**
    * get provider
    *
    *
    */
public static function getProviderInServiceProvider($name, $key)
 {
        $value = null;

        $providerData = DB::table('providers')->where('name', $name)
        ->join('provider_details', 'provider_details.provider_id', '=', 'providers.id')
        ->where('providers.name', $name)
        ->where('provider_details.key', $key)
        ->first();

        if ($providerData) {
            $value = $providerData->value;
        }

        return $value;
        }
}
