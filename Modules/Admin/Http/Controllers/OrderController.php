<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\SiteCommonContent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Emails\OrderStatusChange;
use Modules\Admin\Emails\ProductOutOfStock;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin::order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
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
        $order = Order::find(base64_decode($id));
        if(!$order)
            return view('admin::errors.404');

        return view('admin::order.show',compact('order'));
    }

    /**
     * accept or reject the order
     *
     */
    Public function acceptOrRejectOrder(Request $request)
    {
        $order =Order::find($request->id);
        if(!$order)
            return redirect()->back()->with('error','The requested order was not found!.');
        if($order->order_status_id > 1)
            return redirect()->back()->with('error','The requested order status was already updated!.');

        $order->admin_remarks = $request->remark;
        $order->order_status_id = $request->statusId;
        if($order->save())
        {
            $order->orderDetails()->update(['order_status_id' => $request->statusId]);
            $siteSettings = SiteCommonContent::first();

            //if accepted update out of stock
            if($order->status == 2) {
                foreach($order->orderDetails as $order_detail) {
                    $product = Product::find($order_detail->product_id);
                    if($product) {
                        $stock              = $product->stock - $order_detail->quantity;
                        $product->stock     = $stock > 0 ? $stock : 0;
                        $product->save();
                        if ($product->stock == 0) {
                            Mail::to($siteSettings->enquiry_receive_email)->send(new ProductOutOfStock($product, $siteSettings));
                        }
                    }
                }
            }
            Mail::to($order->user->email)->send(new OrderStatusChange($order, $siteSettings));
            return redirect()->back()->with('success','You have ' . $order->orderStatus->title . ' the Order Successfully.');
        }
        return redirect()->back()->with('error','Something went wrong try again!.');
    }

    /**
     * change status to shipped or delivered
     *
     */
    Public function changeStatus(Request $request)
    {
        $remark =Order::find($request->id);
        $remark->admin_remarks = $request->remark;
        $remark->status = $request->statusId;
        if($remark->save())
        {
            return redirect()->back()->with('success','Admin Remark Added successfully!');
        }
        return redirect()->back()->with('error','Failed to Add Admin Remark');
    }
}
