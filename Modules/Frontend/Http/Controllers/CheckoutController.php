<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Country;
use App\Models\Payment;
use App\Models\Quotation;
use App\Models\SiteCommonContent;
use App\Models\TaxManagement;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($uid)
    {
        if(!$uid)
            return to_route('product')->with('error', 'Something went wrong');

        $quotation = Quotation::where('uid', $uid)
                        ->where('user_id', Auth::guard('web')->id())
                        ->first();

        if(!$quotation)
            return to_route('user.quotation')->with('error', 'No quotation found.');

        if($quotation->quotationDetails->whereIn('status', [0,1])->count() > 1 || $quotation->acceptedQuotationDetails->count() < 1)
            return to_route('user.quotation')->with('error', 'No accepted quotations were found or Some quotation is not accepted.');

        $countries          = Country::all();
        $billing_addresses  = UserAddress::where('user_id', auth()->id())
            ->where('type', 1)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $shipping_addresses = UserAddress::where('user_id', auth()->id())
            ->where('type', 2)
            ->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $payment_methods = Payment::active()->orderBy('sort_order')->get();
        $site_settings = TaxManagement::first();

        $total_tax_amount = 0;

        if($site_settings->tax_percentage) {
            $total_tax_amount += (($quotation->converted_total_bid_price * $site_settings->tax_percentage) / 100);
        }

        if($site_settings->tax_amount) {
            $total_tax_amount += $site_settings->tax_amount;
        }



        return view('frontend::checkout.index', compact('quotation', 'countries', 'billing_addresses', 'shipping_addresses', 'payment_methods', 'site_settings', 'total_tax_amount'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
