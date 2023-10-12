<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Quote;
use App\Models\Product;
use App\Models\Quotation;
use App\Helpers\QuoteHelper;
use Illuminate\Http\Request;
use App\Helpers\FrontendHelper;
use App\Models\QuotationDetail;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Emails\QuotationRequestUserMail;
use Modules\Frontend\Emails\QuotationRequestAdminMail;

class QuoteController extends Controller
{
    //listing all quotes
    public function index()
    {
        $quotes = Quote::where('user_id', Auth::guard('web')->id())->get();
        $subtotal = QuoteHelper::getSubtotal();

        return view('frontend::quote.index', compact('quotes', 'subtotal'));
    }

    //product add to quote
    public function addToQuote(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            if (!$product->is_instock) {
                return response(array(
                    'status' => false,
                    'message' => 'Product is currently out of stock',
                    'count' => QuoteHelper::checkQuote(),
                ), 200, []);
            }

            $quote = Quote::where('user_id', Auth::guard('web')->id())->where('product_id', $product->id)->first();
            if ($quote) {
                $quote->quantity = $request->quantity;
                if ($product->min_quantity_to_buy > $quote->quantity) {
                    $quote->quantity = $product->min_quantity_to_buy;
                }
                $quote->price = $product->price;
                $quote->bid_price = $request->bid_price ?? $product->price;
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
                $quote->bid_price = $request->bid_price ?? $product->price;
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
                'count' => QuoteHelper::checkQuote()
            ), 200, []);
        }
    }

    public function updateQuote(Request $request)
    {
        $quote = Quote::findOrFail($request->input('quote_id'));

        if (!$quote) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }

        if ($quote->product) {
            $quote->quantity = $request->quantity;
            if ($quote->product->min_quantity_to_buy > $quote->quantity) {
                $quote->quantity = $quote->product->min_quantity_to_buy;
            }

            if ($quote->save()) {
                $product_total = FrontendHelper::getCurrencySymbolWithConvertedPrice($quote->product_total_price);
                return response()->json([
                    'status' => true,
                    'product_total' => $product_total
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }

    public function removeFromQuote(Request $request)
    {
        $quote = Quote::findOrFail($request->input('quote_id'));

        if ($quote && $quote->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Item removed successfully',
                'count' => QuoteHelper::checkQuote()
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong try after some time.',]);
        }
    }

    //store quote
    public function submitQuote()
    {
        QuoteHelper::checkProducts();
        $quotes = Quote::where('user_id', Auth::guard('web')->id())->get();
        if($quotes->isEmpty())
            return to_route('product')->with('error', 'Currently you have no item in quote. Please add and continue');

        $quotation = new Quotation();
        $quotation->user_id = Auth::guard('web')->id();
        $quotation->currency = session('currency') ?? 'USD';
        $quotation->currency_rate = session('currency_rate') ?? 1;
        $quotation->currency_symbol = session('currency_symbol') ?? '$';
        $quotation->total_price = 0;
        $quotation->total_bid_price = 0;
        $quotation->status = 0; //waiting for approval
        if($quotation->save()) {
            $storeQuotationDetails = $this->submitQuoteDetails($quotation, $quotes);

            if($storeQuotationDetails){

                $site_settings = SiteCommonContent::first();

                Mail::to($quotation->user->email)->send(new QuotationRequestUserMail($quotation, $site_settings));
                Mail::to($site_settings->enquiry_receive_email)->send(new QuotationRequestAdminMail($quotation, $site_settings));
                return to_route('user.quotation')->with('success', 'Your Request has been submitted.');
            }
            else{
                return to_route('user.quotation')->with('error', 'Something went wrong please try after some time');
            }
        }
    }

    //store quote details data product and price, etc..
    private function submitQuoteDetails($quotation, $quotes) {
        $total_price = $total_bid_price = 0;
        foreach($quotes as $quote) {
            $quotation_details = new QuotationDetail();
            $quotation_details->quotation_id = $quotation->id;
            $quotation_details->product_id = $quote->product_id;
            $quotation_details->price = $quote->price;
            $quotation_details->bid_price = $quote->bid_price;
            $quotation_details->quantity = $quote->quantity;
            $quotation_details->total_price = $quote->quantity * $quote->price;
            $quotation_details->total_bid_price = $quote->quantity * $quote->bid_price;
            $quotation_details->status = 0; //waiting for approval
            $quotation_details->save();

            $total_price += $quotation_details->total_price;
            $total_bid_price += $quotation_details->total_bid_price;
            $quote->delete();
        }

        $quotation->total_price = $total_price;
        $quotation->total_bid_price = $total_bid_price;

        if ($quotation->save()) {
            return true;
        }
        else {
            return false;
        }
    }
}
