<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Provider;
use App\Models\ProviderDetail;

class ProviderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($provider)
    {
        $provider           = Provider::find(base64_decode($provider));
        if ($provider) {
            $provider_details   = ProviderDetail::where('provider_id', $provider->id)->get();

            return view('admin::provider-detail.index', compact(['provider', 'provider_details']));
        }

        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($provider)
    {
        $provider   = Provider::find(base64_decode($provider));

        return view('admin::provider-detail.create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request,Provider $provider)
    {
        $provider = Provider::find($provider->id);

        $request->validate([
            'key'   => 'required',
            'value' => 'required',
        ]);

        $provider_detail                        = new ProviderDetail();
        $provider_detail->provider_id           = $provider->id;
        $provider_detail->key                   = $request->key;
        $provider_detail->value                 = $request->value;

        if ($provider_detail->save()) {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('success', 'Provider Detail created successfully!');
        } else {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('error', 'Failed to create Provider Detail.');
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
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'value.*' => 'required',
        ]);

        $updated = false;

        foreach ($provider->providerDetails  as $index => $providerDetail) {
            $providerDetail->value = $request->input('value.' . $index);
            if ($providerDetail->save()) {
                $updated = true;
            }
        }

        if ($updated) {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('success', 'Provider Detail updated successfully!');
        } else {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('error', 'Failed to update Provider Detail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Provider $provider, ProviderDetail $provider_detail)
    {
        if ($provider_detail->delete()) {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('success', 'Provider Detail deleted successfully.');
        } else {
            return redirect()->route('provider-detail.index', ['provider' => base64_encode($provider->id)])->with('error', 'Failed to delete Provider Detail.');
        }
    }
}
