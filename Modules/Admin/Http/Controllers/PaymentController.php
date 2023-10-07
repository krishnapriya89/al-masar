<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $payments = payment::latest()->get();
        return view('admin::payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::payment.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, Payment $payment)
    {
        $request->validate([
            'title' => 'required|max:255|unique:payments,title,NULL,id,deleted_at,NULL',
            'sort_order' => 'nullable|integer|min:0',
            'image'    => 'required',
        ]);
        $payment->title = $request->title;
        $payment->description = $request->description;
        $payment->type = 1;
        $payment->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $payment->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $payment->image = $payment->uploadImage($file, $payment->getImageDirectory());
        }
        if ($payment->save()) {
            return to_route('payment.index')->with('success', 'Payment Added Successfully!');
        }
        return to_route('payment.index')->with('error', 'Failed to add Payment');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $payment = Payment::find(base64_decode($id));
        return view('admin::payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable'
        ]);
        $payment = Payment::find($id);
        $payment->title = $request->title;
        $payment->description = $request->description;
        $payment->type = 1;
        $payment->sort_order = $request->filled('sort_order') ? $request->sort_order : 0;
        $payment->status = $request->status;
        if ($request->hasFile('image')) {
            if($payment->image!=null||$payment->image!='')
            $payment->deleteImage('image');
            $file = $request->file('image');
            $payment->image = $payment->uploadImage($file, $payment->getImageDirectory());
        }
        if ($payment->save()) {
            return to_route('payment.index')->with('success', 'Payment Upadted Successfully!');
        }
        return to_route('payment.index')->with('error', 'Failed to Update Payment');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Payment $payment)
    {
        // if($payment->delete())
        // {
        //     return to_route('payment.index')->with('success','Payment Deleted Successfully!');
        // }
        // return to_route('payment.index')->with('error','Payment Deleted Successfully!');
    }
}
