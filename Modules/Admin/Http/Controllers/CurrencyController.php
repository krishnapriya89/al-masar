<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\CurrencyRate;
use App\Models\CurrencyCodeMaster;
use Modules\Admin\Http\Requests\CurrencyRateRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $currencies = CurrencyRate::latest()->get();
        return view('admin::currency.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $currency_codes = CurrencyCodeMaster::get();
        return view('admin::currency.create',compact('currency_codes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CurrencyRateRequest $request,CurrencyRate $currency)
    {
        $currency->code_id = $request->code;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        $currency->sort_order = $request->filled('sort_order') ? $request->sort_order:0;
        $currency->status = $request->status;
        if($currency->save())
        {
            return to_route('currency.index')->with('success','Currency Added Successfully!');
        }
        return to_route('currency.index')->with('error',' Failed to Add Currency Details');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $currency = CurrencyRate::find(base64_decode($id));
        $currency_codes = CurrencyCodeMaster::get();
        return view('admin::currency.edit',compact('currency','currency_codes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CurrencyRateRequest $request, $id)
    {
        $currency = CurrencyRate::find($id);
        $currency->code_id = $request->code;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        $currency->sort_order = $request->filled('sort_order') ? $request->sort_order:0;
        $currency->status = $request->status;
        if($currency->save())
        {
            return to_route('currency.index')->with('success','Currency Updated Successfully!');
        }
        return to_route('currency.index')->with('error',' Failed to Update Currency Details');
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
