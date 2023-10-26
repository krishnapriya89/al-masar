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

    //quotation list filter
    public function filter(Request $request)
    {
        $quotations = Quotation::where('user_id', Auth::guard('web')->id())->where('status', '!=', 5)
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->latest()->get();
        return view('frontend::includes.quotation-list', compact('quotations'));
    }
    //quotation list filter in mob responsive
    public function filterMob(Request $request)
    {
        $quotations = Quotation::where('user_id', Auth::guard('web')->id())->where('status', '!=', 5)
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->latest()->get();
        return view('frontend::includes.quotation-list-mob', compact('quotations'));
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

        if ($quotation_detail->save()) {
            $quotation = $quotation_detail->quotation;

            $quotation->total_bid_price = $quotation->activeQuotationDetails->sum('total_bid_price');

            //check if no one is accepted and any one of them is requote
            if ($request->status == 1 || $quotation->quotationDetails->where('status', 1)->count() > 0) {
                $quotation->status = 1;
                $quotation->save();
            } else {
                //check any product quotation accepted then mark quotation table accepted
                if(($request->status == 2 || $quotation->acceptedQuotationDetails->count() > 0) && $quotation->quotationDetails->where('status', 1)->count() == 0) {
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

            $submit_quotation = false;
            if($quotation->quotationDetails->whereIn('status', [0,1])->count() < 1 && $quotation->acceptedQuotationDetails->count() > 0)
                $submit_quotation = true;

            return response()->json([
                'status' => true,
                'quotation_uid' => $quotation->uid,
                'quotation_status' => $quotation->status_value,
                'quotation_status_class' => $quotation->status_class,
                'quotation_detail_status' => $quotation_detail->status_value,
                'quotation_detail_status_class' => $quotation_detail->status_class,
                'quotation_total_bid_price' => $quotation->priceWithSymbol($quotation->total_bid_price),
                'submit_quotation' => $submit_quotation,
                'message' => 'Status changed successfully'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }
    }
}
