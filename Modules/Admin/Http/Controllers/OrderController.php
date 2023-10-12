<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

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
        $order_statuses     = OrderStatus::all();
        return view('admin::order.show',compact('order','order_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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

    /**
     * add admin remark
     *
     */
    Public function addRemark(Request $request)
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
