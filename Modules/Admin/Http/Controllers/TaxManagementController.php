<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TaxManagement;

class TaxManagementController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $tax_management = TaxManagement::first();
        return view('admin::tax-management.edit',compact('tax_management'));
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
        'tax_name' => 'required',
        'tax_percentage'=>'required',
        'tax_amount'=>'required'
       ]);
       $tax_management = TaxManagement::find($id);
       $tax_management->tax_name = $request->tax_name;
       $tax_management->tax_percentage = $request->tax_percentage;
       $tax_management->tax_amount = $request->tax_amount;
       if($tax_management->save())
       {
        return redirect()->back()->with('success','Tax Management Details Updated Successfully!');
       }
       return redirect()->back()->with('error','Failed to Update Tax Management Details');
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
