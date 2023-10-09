<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Quotation;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Models\QuotationDetail;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Emails\QuotationStatusMail;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $quotations = Quotation::where('status', '!=', 5)->latest()->get();
        return view('admin::quotation.index', compact('quotations'));
    }

    //updating all status of quotation
    public function changeQuotationStatus(Request $request)
    {
        $request->validate([
            'quotation_uid' => 'required'
        ]);

        $quotation = Quotation::where('uid', $request->quotation_uid)->first();

        if(!$quotation)
            return response()->json(['status' => false, 'message' => 'Failed to update!']);

        if ($quotation->status > 0)
            return response()->json(['status' => false, 'message' => 'Already updated please refresh the page!']);

        $quotation->status = $request->status;

        //rejected
        if($quotation->status == 3){
            $quotation->total_bid_price = 0;
        }

        if ($quotation->save()) {
            //update in detail table
            foreach($quotation->quotationDetails as $quotation_detail) {
                $quotation_detail->remarks = $request->remarks;
                $quotation_detail->status = $request->status;

                //accepted
                if($quotation->status == 2){
                    $quotation_detail->admin_approved_price = $quotation_detail->bid_price;
                }

                $quotation_detail->save();
            }

            $site_settings = SiteCommonContent::first();

            Mail::to($quotation->user->email)->send(new QuotationStatusMail($quotation, $site_settings));
            session()->flash('success', 'Status changed successfully');
            return response()->json(['status' => true]);
        }
        else {
            session()->flash('success', 'Something went wrong');
            return response()->json(['status' => false]);
        }
    }

    //updating quotation detail status
    public function changeQuotationDetailStatus(Request $request)
    {
        $request->validate([
            'quotation_detail_id' => 'required',
            'remarks' => 'required_if:status,3',
            'amount' => 'required_if:status,1'
        ]);

        $quotation_detail = QuotationDetail::find($request->quotation_detail_id);

        if (!$quotation_detail) {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }

        //check the status is not waiting for approval if not return false
        if ($quotation_detail->status > 0) {
            return response()->json(['status' => false, 'message' => 'Already updated please refresh the page!']);
        }

        $quotation_detail->status = $request->status;

        $quotation_detail->remarks = $request->remarks ?? null;

        //requote
        if ($quotation_detail->status == 1) {
            $quotation_detail->admin_approved_price = $request->amount;
            $quotation_detail->total_bid_price = $quotation_detail->admin_approved_price * $quotation_detail->quantity;
        }
        //accepted
        else if($quotation_detail->status == 2){
            $quotation_detail->admin_approved_price = $quotation_detail->bid_price;
            $quotation_detail->total_bid_price = $quotation_detail->admin_approved_price * $quotation_detail->quantity;
        }

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

            if($quotation->quotationDetails->where('status', 0)->count() == 0) {
                $site_settings = SiteCommonContent::first();

                Mail::to($quotation->user->email)->send(new QuotationStatusMail($quotation, $site_settings));
            }

            $quotation_status_class = $quotation->status_class;
            $quotation_status_value = $quotation->admin_status_value;

            if($quotation->quotationDetails->where('status',  0)->count() > 0) {
                $quotation_status_class = 'clr4';
                $quotation_status_value = 'Waiting for approval';
            }

            return response()->json([
                'status' => true,
                'quotation_uid' => $quotation->uid,
                'quotation_status' => $quotation_status_value,
                'quotation_status_class' => $quotation_status_class,
                'quotation_detail_status' => $quotation_detail->admin_status_value,
                'quotation_detail_status_class' => $quotation_detail->status_class,
                'quotation_total_bid_price' => AdminHelper::getFormattedPrice($quotation->total_bid_price),
                'quotation_detail_bid_price' => AdminHelper::getFormattedPrice($quotation_detail->admin_approved_price),
                'quotation_detail_total_bid_price' => AdminHelper::getFormattedPrice($quotation_detail->total_bid_price),
                'message' => 'Status changed successfully'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }
    }
}
