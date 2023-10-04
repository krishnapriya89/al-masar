<?php

namespace App\Helpers;

use App\Models\Quote;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class QuoteHelper
{
    //get quote count of a user
    public static function checkQuote()
    {
        self::checkProducts();

        $quoteCount  = Quote::where('user_id', Auth::guard('web')->id())->count();
        return $quoteCount;
    }

    //check if any product in the quote is not active or out of stock then removing it
    public static function checkProducts()
    {
        $quotes = Quote::where('user_id', Auth::guard('web')->id())->get();

        foreach ($quotes as $quote) {
            $product = Product::where('id', $quote->product_id)
                ->active()
                ->where('stock', '>', 0)
                ->where('stock_status', 1)
                ->first();

            if (!$product) {
                $quote->delete();
            }
        }
    }

    public static function getSubtotal()
    {
        $carts      = Quote::where('user_id', Auth::guard('web')->id())->sum();
        $price      = 0;
        foreach ($carts as $cart) {
            $price += $cart->product->price * $cart->quantity;
        }

        return $price;
    }

}