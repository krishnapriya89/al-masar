<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Country;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CountryRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $countries = Country::latest()->get();
        return view('admin::country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::country.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CountryRequest $request)
    {
        $country = new Country();
        $country->title = $request->title;
        $country->code = $request->code;
        $country->status = $request->status;
        if ($country->save()) {
            return redirect()->route('country.index')->with('success', 'Country created successfully');
        } else {
            return redirect()->route('country.index')->with('error', 'Failed to create country');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $country = Country::find(base64_decode($id));
        return view('admin::country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->title = $request->title;
        $country->code = $request->code;
        $country->status = $request->status;
        if ($country->save()) {
            return redirect()->route('country.index')->with('success', 'Country updated successfully');
        } else {
            return redirect()->route('country.index')->with('error', 'Failed to update country');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Country $country)
    {
        if ($country->delete()) {
            return redirect()->route('country.index')->with('success', 'Country deleted successfully');
        } else {
            return redirect()->route('country.index')->with('error', 'Failed to delete country');
        }
    }
}
