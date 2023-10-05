<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationDetail;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    public function changeStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:2,3,4',
            'quotation_detail_id' => 'required',
            'remark' => 'required_if:status,3',
            'amount' => 'required_if:status,4'
        ]);

        $quotation_detail = QuotationDetail::find($request->quotation_detail_id);

        if (!$quotation_detail) {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }

        //check the status is not waiting for approval if not return false
        if ($quotation_detail->status > 0) {
            return response()->json(['status' => false, 'message' => 'Already updated please refresh the page!']);
        }

        $quotation_detail->status = 2;//action from vendor
        $quotation_detail->remarks = $request->remarks ?? null;

        //check is requote
        if ($quotation_detail->status == 4)
            $quotation_detail->admin_approved_price = $request->amount;
        else
            $quotation_detail->admin_approved_price = $quotation_detail->bid_price;

        if ($quotation_detail->save()) {
            return response()->json([
                'status' => true, 
                'quotation_id' => $quotation_detail->quotation->uid, 
                'detail_status' => $quotation_detail->status_value, 
                'message' => 'Status changed successfully'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to update!']);
        }
    }
}
