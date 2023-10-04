<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Http\Requests\UserAddressRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Country;
use App\Models\State;


class UserController extends Controller
{

  //user dashboard
  public function dashboard()
  {
    return view('frontend::user.dashboard');
  }

  /**
   * Add New Address
   *
   */
  public function addBillingAddress()
  {
    $countries = Country::active()->get();
    $states = State::active()->get();
    return view('frontend::user.add-billing-address', compact('countries', 'states'));
  }

  /**
   * Store Billing Address
   *
   */
  public function storeBillingAddress(UserAddressRequest $request)
  {
    dd($request->all());
  }
}
