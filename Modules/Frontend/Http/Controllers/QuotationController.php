<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Quote;
use App\Models\Quotation;
use App\Helpers\QuoteHelper;
use Illuminate\Http\Request;
use App\Models\QuotationDetail;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Emails\QuotationRequestUserMail;
use Modules\Frontend\Emails\QuotationRequestAdminMail;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $quotations = Quotation::where('user_id', Auth::guard('web')->id())->where('status', '!=', 4)->latest()->get();
        return view('frontend::quotation.index', compact('quotations'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store()
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
        $quotation->total = QuoteHelper::getSubtotal();
        $quotation->status = 0; //waiting for approval
        if($quotation->save()) {
            $storeQuotationDetails = $this->storeQuotationDetails($quotation, $quotes);

            if($storeQuotationDetails){

                $site_settings = SiteCommonContent::first();

                Mail::to($quotation->user->email)->send(new QuotationRequestUserMail($quotation, $site_settings));
                Mail::to($site_settings->enquiry_receive_email)->send(new QuotationRequestAdminMail($quotation, $site_settings));
                
                return to_route('product')->with('success', 'Your Request has been submitted.');
            }
            else{
                return to_route('product')->with('error', 'Something went wrong please try after some time');
            }
        }
    }

    //store quotation details data product and price, etc..
    private function storeQuotationDetails($quotation, $quotes) {
        $total_amount = 0;
        foreach($quotes as $quote) {
            $quotation_details = new QuotationDetail();
            $quotation_details->quotation_id = $quotation->id;
            $quotation_details->product_id = $quote->product_id;
            $quotation_details->price = $quote->price;
            $quotation_details->bid_price = $quote->bid_price;
            $quotation_details->quantity = $quote->quantity;
            $quotation_details->total = $quote->product_total_price;
            $quotation_details->status = 0; //waiting for approval
            $quotation_details->save();

            $total_amount += $quotation_details->total;
        }

        $quotation->total = $total_amount;
        if ($quotation->save()) {
            return true;
        }
        else {
            return false;
        }
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
