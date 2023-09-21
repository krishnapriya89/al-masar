<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Rules\UniqueStateInCountry;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\StateRequest;

use function PHPUnit\Framework\containsIdentical;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($country_id)
    {
        $country = Country::find(base64_decode($country_id));
        $states = State::where('country_id' , $country->id)->latest()->get();
        return view('admin::state.index', compact('states', 'country'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($country_id)
    {
        $country = Country::find(base64_decode($country_id));
        return view('admin::state.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StateRequest $request)
    {
        $state = new State();
        $state->country_id = base64_decode($request->country_id);
        $state->title = $request->title;
        $state->code = $request->code;
        $state->status = $request->status;
        if ($state->save()) {
            return redirect()->route('state.index', $request->country_id)->with('success', 'State created successfully');
        } else {
            return redirect()->route('state.index', $request->country_id)->with('error', 'Failed to create state');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $state = State::find(base64_decode($id));
        return view('admin::state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StateRequest $request, State $state)
    {
        $state->title = $request->title;
        $state->code = $request->code;
        $state->status = $request->status;
        if ($state->save()) {
            return redirect()->route('state.index', base64_encode($state->country_id))->with('success', 'State updated successfully');
        } else {
            return redirect()->route('state.index', base64_encode($state->country_id))->with('error', 'Failed to update state');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(State $state)
    {
        $country_id = $state->country_id;
        if ($state->delete()) {
            return redirect()->route('state.index', base64_encode($country_id))->with('success', 'State deleted successfully');
        } else {
            return redirect()->route('state.index', base64_encode($country_id))->with('error', 'Failed to delete state');
        }
    }
}
