<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Admin\Http\Requests\VendorRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $countries = Vendor::latest()->get();
        return view('admin::vendor.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(VendorRequest $request)
    {
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->status = $request->status;
        if ($vendor->save()) {
            return redirect()->route('vendor.index')->with('success', 'Vendor created successfully');
        } else {
            return redirect()->route('vendor.index')->with('error', 'Failed to create vendor');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $vendor = Vendor::find(base64_decode($id));
        return view('admin::vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(VendorRequest $request, Vendor $vendor)
    {
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->status = $request->status;
        if ($vendor->save()) {
            return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully');
        } else {
            return redirect()->route('vendor.index')->with('error', 'Failed to update vendor');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Vendor $vendor)
    {
        if ($vendor->delete()) {
            return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully');
        } else {
            return redirect()->route('vendor.index')->with('error', 'Failed to delete vendor');
        }
    }
}
