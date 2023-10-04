<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Quote;
use App\Models\Product;
use App\Helpers\QuoteHelper;
use Illuminate\Http\Request;
use App\Helpers\FrontendHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;

class QuoteController extends Controller
{
    //product add to quote
    public function addToQuote(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            if ($product->is_instock) {
                return response(array(
                    'status' => false,
                    'message' => 'Product is currently out of stock',
                    'count' => QuoteHelper::checkQuote(),
                ), 400, []);
            }
            
            $quote = Quote::where('user_id', Auth::guard('web')->id())->where('product_id', $product->id)->first();
            if ($quote) {
                $quote->quantity += $request->quantity;
                if ($product->min_quantity_to_buy > $quote->quantity) {
                    $quote->quantity = $product->min_quantity_to_buy;
                }
                $quote->price = $product->price;
                $quote->bid_price = $request->bid_price;
                $quote->save();

                return response(array(
                    'status' => true,
                    'message' => 'Item added to quote successfully',
                    'count' => QuoteHelper::checkQuote(),
                ), 200, []);
            } else {
                $quote = new Quote;
                $quote->product_id = $product->id;
                $quote->quantity = $request->quantity;
                $quote->price = $product->price;
                $quote->bid_price = $request->bid_price;
                $quote->user_id = Auth::guard('web')->id();
                
                if ($quote->save()) {
                    return response(array(
                        'status' => true,
                        'message' => 'Item added to quote successfully',
                        'count' => QuoteHelper::checkQuote()
                    ), 200, []);
                } else {
                    return response(array(
                        'status' => false,
                        'message' => 'Something went wrong',
                        'count' => QuoteHelper::checkQuote()
                    ), 200, []);
                }
            }
        } else {
            return response(array(
                'status' => false,
                'message' => 'Product not available',
            ), 200, []);
        }
    }

    public function updateQuote(Request $request)
    {
        $quote = Quote::findOrFail($request->input('quote_id'));
        $quantity = $request->input('quantity');

        if (!$quote) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }

        if ($quote->product) {
            $quote->quantity += $request->quantity;
            if ($quote->product->min_quantity_to_buy > $quote->quantity) {
                $quote->quantity = $quote->product->min_quantity_to_buy;
            }

            if ($quote->save()) {
                $product_total = FrontendHelper::getCurrencySymbolWithConvertedPrice($quote->quantity * $quote->product->price);
                $sub_total = FrontendHelper::getCurrencySymbolWithConvertedPrice(QuoteHelper::getSubtotal());
                return response()->json([
                    'status' => true,
                    'product_total' => $product_total,
                    'sub_total' => $sub_total,
                ]);
            }
        }

        return response()->json(['status' => false]);
    }

    // public function removeFromQuote(Request $request)
    // {
    //     $this->forgetCoupon();
    //     $quote = Quote::findOrFail($request->input('quote_id'));

    //     if ($quote && $quote->delete()) {
    //         $userCheck = QuoteHelper::userCheck();
    //         $quote_count = QuoteHelper::checkQuote();
    //         $quotes = Quote::where($userCheck['key'], $userCheck['value'])->get();
    //         $quote_contents = View::make('frontend::includes.quote_modal_list', compact('quotes'))->render();
    //         $subtotal = QuoteHelper::getSubtotal();
    //         return response()->json([
    //             'status' => true,
    //             'quote_count' => $quote_count,
    //             'quote_contents' => $quote_contents,
    //             'sub_total' => FrontendHelper::getCurrencyWithConvertedPrice($subtotal)
    //         ]);
    //     } else {
    //         return response()->json(['status' => false]);
    //     }
    // }

    // public function quoteEmpty()
    // {
    //     $this->forgetCoupon();
    //     $userCheck = QuoteHelper::userCheck();

    //     if (Quote::where($userCheck['key'], $userCheck['value'])->delete()) {
    //         $quote_content = View::make('frontend::includes.quote_modal_empty')->render();
    //         return response()->json(['status' => true, 'quote_content' => $quote_content, 'sub_total' => FrontendHelper::getCurrencyWithConvertedPrice(QuoteHelper::getSubtotal())]);
    //     }
    //     return response()->json(['status' => false]);
    // }

    // public function index()
    // {
    //     $userCheck = QuoteHelper::userCheck();
    //     $quotes = Quote::where($userCheck['key'], $userCheck['value'])->get();
    //     $subtotal = QuoteHelper::getSubtotal();

    //     $banner = BannerAndMetaTag::page('quote');

    //     return view('frontend::quote', compact('quotes', 'subtotal', 'banner'));
    // }
}
