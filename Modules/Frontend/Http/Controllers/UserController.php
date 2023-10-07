<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Http\Requests\UserAddressRequest;


class UserController extends Controller
{

    //user dashboard
    public function dashboard()
    {
        return view('frontend::user.dashboard');
    }

    /**
     * Add Address
     *
     */
    public function newAddress()
    {
        $shipping_addresses = UserAddress::where('user_id',Auth::guard('web')->id())->where('type',2)->get();
        $billing_addresses = UserAddress::where('user_id',Auth::guard('web')->id())->where('type',1)->get();
        return view('frontend::user.address-listing',compact('shipping_addresses','billing_addresses'));
    }

    /**
     * Add Billing Address
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
    public function storeBillingAddress(Request $request, UserAddress $billing_address)
    {
        $existingBillingAddress     = UserAddress::where('user_id', Auth::guard('web')->id())
            ->where('type', 1)
            ->where('is_default', 1)
            ->first();

        $billing_address->user_id           = Auth::guard('web')->id();
        $billing_address->type              = $request->type;
        $billing_address->first_name        = $request->first_name;
        $billing_address->last_name         = $request->last_name;
        $billing_address->address_one       = $request->address_one;
        $billing_address->address_two       = $request->address_two;
        $billing_address->city              = $request->city;
        $billing_address->country_id        = $request->country;
        $billing_address->city              = $request->city;
        $billing_address->zip_code          = $request->zip_code;
        $billing_address->state_id          = $request->state;

        if ($existingBillingAddress) {
            $existingBillingAddress->is_default = 0;
            $existingBillingAddress->save();
        }

        $billing_address->is_default        = 1;

        if ($billing_address->save()) {
            return redirect()->route('address')->with('success', 'Billing Address has been Added Successfully!');
        } else {
            return redirect()->route('address')->with('error', 'Failed to Add Billing Address');
        }
    }

    /**
     * Edit Billing Address
     *
     */
    public function editBillingAddress($id)
    {
        try {
            $billing_address    = UserAddress::find(decrypt($id));
            // $billing_address    = UserAddress::find($id);
            // $isFirstAddress     = UserAddress::where('user_id', auth()->id())->where('id', '<', decrypt($id))->where('type', 1)->doesntExist();
            $countries          = Country::active()->get();
            $states             = State::active()->get();

            return view('frontend::user.edit-billing-address', compact('billing_address', 'countries', 'states'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Update Billing Address
     *
     */
    public function updateBillingAddress(Request $request, $id)
    {
        $billing_address            = UserAddress::find($id);
        $existingBillingAddress     = UserAddress::where('user_id', Auth::guard('web')->id())
            ->where('type', 1)
            ->where('is_default', 1)
            ->first();

        $billing_address->first_name        = $request->first_name;
        $billing_address->last_name         = $request->last_name;
        $billing_address->address_one       = $request->address_one;
        $billing_address->address_two       = $request->address_two;
        $billing_address->city              = $request->city;
        $billing_address->country_id        = $request->country;
        $billing_address->city              = $request->city;
        $billing_address->zip_code          = $request->zip_code;
        $billing_address->state_id          = $request->state;

        if ($existingBillingAddress) {
            $existingBillingAddress->is_default = 0;
            $existingBillingAddress->save();
        }

        $billing_address->is_default        = 1;

        if ($billing_address->save()) {
            return redirect()->route('address')->with('success', 'Billing Address has been updated successfully!');
        } else {
            return redirect()->route('address')->with('error', 'Failed to update billing address');
        }
    }

    /**
     * Add Shipping Address
     *
     */
    public function addShippingAddress()
    {
        $countries = Country::active()->get();
        $states = State::active()->get();
        return view('frontend::user.add-shipping-address', compact('countries', 'states'));
    }

    /**
     * Store Shipping Address
     *
     */
    public function storeShippingAddress(Request $request)
    {
        $existingShippingAddress = UserAddress::where('user_id', auth()->id())
            ->where('type', 2)
            ->where('is_default', 1)
            ->first();

        $shipping_address                    = new UserAddress();
        $shipping_address->user_id           = Auth::guard('web')->id();
        $shipping_address->type              = $request->type;
        $shipping_address->first_name        = $request->first_name;
        $shipping_address->last_name         = $request->last_name;
        $shipping_address->address_one       = $request->address_one;
        $shipping_address->address_two       = $request->address_two;
        $shipping_address->city              = $request->city;
        $shipping_address->country_id        = $request->country;
        $shipping_address->city              = $request->city;
        $shipping_address->zip_code          = $request->zip_code;
        $shipping_address->state_id          = $request->state;


        if ($existingShippingAddress) {
            $existingShippingAddress->is_default = 0;
            $existingShippingAddress->save();
        }

        if ($shipping_address->save()) {
            // Session::flash('form', 'shipping-address');
            return redirect()->route('address')->with('success', 'Shipping address has been added successfully.');
        } else {
            // Session::flash('form', 'shipping-address');
            return redirect()->route('address')->with('error', 'An error occurred while adding the shipping address.');
        }
    }

    /**
     * Edit Shipping Address
     *
     */
    public function editShippingAddress($id)
    {
        try {
            $shipping_address   = UserAddress::find(decrypt($id));
            $countries          = Country::active()->get();
            $states             = State::active()->get();

            return view('frontend::user.edit-shipping-address', compact('shipping_address', 'countries', 'states'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Update Shipping Address
     *
     */
    public function updateShippingAddress(Request $request, $id)
    {
        $existingShippingAddress    = UserAddress::where('user_id', Auth::guard('web')->id())
            ->where('type', 2)
            ->where('is_default', 1)
            ->first();
        $shipping_address                   = UserAddress::find($id);
        $shipping_address->first_name        = $request->first_name;
        $shipping_address->last_name         = $request->last_name;
        $shipping_address->address_one       = $request->address_one;
        $shipping_address->address_two       = $request->address_two;
        $shipping_address->city              = $request->city;
        $shipping_address->country_id        = $request->country;
        $shipping_address->city              = $request->city;
        $shipping_address->zip_code          = $request->zip_code;
        $shipping_address->state_id          = $request->state;

        if ($existingShippingAddress) {
            $existingShippingAddress->is_default = 0;
            $existingShippingAddress->save();
        }
        $shipping_address->is_default        = 1;
        if ($shipping_address->save()) {
            return redirect()->route('address')->with('success', 'Shipping address has been updated successfully');
        } else {
            return redirect()->route('address')->with('error', 'An error occurred while updating the shipping address.');
        }
    }

    /**
     * update default
     */
    public function updateDefault(Request $request)
    {
        $address = UserAddress::findOrFail($request->input('id'));
        if ($address) {
            if ($address->is_default == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'This is already the default address'
                ]);
            }
            $existingBillingAddress = UserAddress::where('user_id', Auth::guard('web')->id())
                ->where('type',$request->type)
                ->where('is_default', 1)
                ->first();
            if ($existingBillingAddress) {
                $existingBillingAddress->is_default = 0;
                $existingBillingAddress->save();
            }
            $address->is_default = 1;
            if ($address->save()) {
                return response()->json([
                    'id'=> $request->id,
                    'status' => true,
                    'message' => 'Default address changed successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to update'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update'
            ]);
        }
    }

    /**
     * Destroy Address
     *
     */
    public function destroyAddress(Request $request)
    {
        $address = UserAddress::findOrFail($request->input('id'));

        if ($address && $address->delete()) {
            $defaultAddress = UserAddress::where('user_id', auth()->id())
                ->where('is_default', 1)
                ->first();
            if (!$defaultAddress) {
                $existingAddress = UserAddress::where('user_id', auth()->id())
                    ->where('is_default', 0)
                    ->latest()
                    ->first();

                if ($existingAddress) {
                    $existingAddress->is_default = 1;
                    if ($existingAddress->save()) {
                        $defaultId =  $existingAddress->id;
                    }
                } else {
                    return response()->json(['success' => true, 'flag' => 2, 'message' => 'Address deleted successfully.']);
                }
            } else {
                $defaultId = $defaultAddress->id;
            }
            return response()->json(['success' => true, 'flag' => 1, 'defaultId' => $defaultId, 'message' => 'Address deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'An error occurred while deleting the address.']);
    }
}
