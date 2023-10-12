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
        return view('admin::order.index', compact('orders'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($uid)
    {
        $order = Order::where('uid', $uid)->first();
        if (!$order)
            return view('admin::errors.404');
        $prev_order         = Order::where('id', '<', $order->id)->latest('id')->first();
        $next_order         = Order::where('id', '>', $order->id)->oldest('id')->first();
        return view('admin::order.show', compact('order', 'prev_order', 'next_order'));
    }

    /**
     * accept or reject the order
     *
     */
    public function acceptOrRejectOrder(Request $request)
    {
        $order = Order::where('uid', $request->uid)->first();
        if (!$order)
            return redirect()->back()->with('error', 'The requested order was not found!.');
        if ($order->order_status_id > 1)
            return redirect()->back()->with('error', 'The requested order status was already updated!.');

        $order->admin_remarks = $request->remark;
        $order->order_status_id = $request->statusId;
        if ($order->save()) {
            $order->orderDetails()->update(['order_status_id' => $request->statusId]);
            $siteSettings = SiteCommonContent::first();

            //if accepted update out of stock
            if ($order->order_status_id == 2) {
                foreach ($order->orderDetails as $order_detail) {
                    $product = Product::find($order_detail->product_id);
                    if ($product) {
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
            return redirect()->back()->with('success', 'You have changed the order status to ' . $order->orderStatus->title . ' Successfully.');
        }
        return redirect()->back()->with('error', 'Something went wrong try again!.');
    }

    /**
     * change status to shipped or delivered
     *
     */
    public function updateOrderStatus(Request $request)
    {
        $order = Order::where('uid', $request->uid)->first();
        if (!$order)
            return response()->json([
                'status' => false,
                'message' => 'The requested order was not found!.'
            ]);
        if ($order->order_status_id == 1 || $order->order_status_id >= 4)
            return response()->json([
                'status' => false,
                'message' => 'The requested order status was already updated.'
            ]);

        $order->order_status_id = $request->order_status;
        if ($order->save()) {
            $order->orderDetails()->update(['order_status_id' => $order->order_status_id]);
            $siteSettings = SiteCommonContent::first();
            Mail::to($order->user->email)->send(new OrderStatusChange($order, $siteSettings));
            $updated_status = '';
            if($order->order_status_id == 4)
                $updated_status = '<span class="status ' . $order->status_class . '">' . $order->orderStatus->title . '</span>';

            return response()->json([
                'status' => true,
                'updated_status' => $updated_status,
                'message' => 'Order status changes successfully!.'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Failed to update status!.'
        ]);
    }
}
