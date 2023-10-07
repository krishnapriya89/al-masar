<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\Quote;
use App\Models\Quotation;
use App\Helpers\AdminHelper;
use App\Helpers\QuoteHelper;
use Illuminate\Http\Request;
use App\Models\QuotationDetail;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        $quotations = Quotation::where('user_id', Auth::guard('web')->id())->where('status', '!=', 5)->latest()->get();
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
        $quotation->total_price = 0;
        $quotation->total_bid_price = 0;
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

    //vendor action from quotation page agree / reject the requote
    public function vendorAction(Request $request) {
        $quotation_detail = QuotationDetail::find($request->id);

        if(!$quotation_detail)
            return response()->json(['status' => false, 'message' => 'Failed to update!']);

        //check the status is not requote (action from vendor) if not return false
        if ($quotation_detail->status != 1)
            return response()->json(['status' => false, 'message' => 'Already updated please refresh the page!']);

        $quotation_detail->status = $request->status;

        //rejected
        if($quotation_detail->status == 4){
            $quotation_detail->total_bid_price = 0;
        }

        if ($quotation_detail->save()) {
            $quotation = $quotation_detail->quotation;

            $quotation->total_bid_price = $quotation->quotationDetails->sum('total_bid_price');

            //check if no one is accepted and any one of them is requote
            if ($request->status == 1 || $quotation->quotationDetails->where('status', 1)->count() > 0) {
                $quotation->status = 1;
                $quotation->save();
            } else {
                //check any product quotation accepted then mark quotation table accepted
                if(($request->status == 2 || $quotation->quotationDetails->where('status', 2)->count() > 0) && $quotation->quotationDetails->where('status', 1)->count() == 0) {
                    $quotation->status = 2;
                    $quotation->save();
                }
                else {
                    //Other wise saving the majority status of the quotation details
                    $majorityStatus = QuotationDetail::select('status', DB::raw('COUNT(*) as count'))
                        ->where('quotation_id', $quotation_detail->quotation_id)
                        ->groupBy('status')
                        ->orderByDesc('count')
                        ->limit(1)
                        ->pluck('status')
                        ->first();

                    $quotation->status = $majorityStatus;
                    $quotation->save();
                }
            }

            return response()->json([
                'status' => true,
                'quotation_uid' => $quotation->uid,
                'quotation_status' => $quotation->status_value,
                'quotation_status_class' => $quotation->status_class,
                'quotation_detail_status' => $quotation_detail->status_value,
                'quotation_detail_status_class' => $quotation_detail->status_class,
                'quotation_total_bid_price' => AdminHelper::getFormattedPrice($quotation->total_bid_price),
                'message' => 'Status changed successfully'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }
    }
}
