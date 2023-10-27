<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Country;
use App\Models\Payment;
use App\Models\ProfileOtp;
use App\Models\OrderStatus;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\FrontendHelper;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Http\Requests\UserAddressRequest;
use Modules\Frontend\Http\Requests\UserRegisterRequest;
use Modules\Frontend\Http\Requests\UserProfileUpdateRequest;

class UserController extends Controller
{
    //user dashboard
    public function dashboard()
    {
        Session::put('address_tab', 'billing');
        $pending_order_count = Order::where('user_id', Auth::guard('web')->id())->where('order_status_id', 1)->count();
        $accepted_order_count = Order::where('user_id', Auth::guard('web')->id())->where('order_status_id', 2)->count();
        $delivered_order_count = Order::where('user_id', Auth::guard('web')->id())->where('order_status_id', 4)->count();
        $rejected_order_count = Order::where('user_id', Auth::guard('web')->id())->where('order_status_id', 5)->count();
        $amount_to_be_paid_query = Order::where('user_id', Auth::guard('web')->id())->where('order_status_id', '!=', 5)
            ->where(DB::raw('grand_total'), '>', DB::raw('payment_received_amount'));
        $amount_to_be_paid_order_count = $amount_to_be_paid_query->count();
        $total_amount_to_be_py = $amount_to_be_paid_query->sum(DB::raw('grand_total - payment_received_amount'));

        //graph data
        $currentYear = Carbon::now()->year;

        //delivered order count
        $graph_data = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as order_count')
            )
            ->where('user_id', Auth::guard('web')->id())->where('order_status_id', 4)
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->pluck('order_count', 'month')
            ->toArray();

        // Fill in months with no orders with a count of 0
        for ($month = 1; $month <= 12; $month++) {
            if (!isset($graph_data[$month])) {
                $graph_data[$month] = 0;
            }
        }

        ksort($graph_data); //sort by month

        $graph_data = array_values($graph_data); //removing index
        //end graph data

        return view('frontend::user.dashboard', compact(
            'pending_order_count',
            'accepted_order_count',
            'delivered_order_count',
            'rejected_order_count',
            'amount_to_be_paid_order_count',
            'total_amount_to_be_py',
            'graph_data'
        ));
    }

    /**
     * Profile
     *
     */
    public function profile() {
        Session::put('address_tab', 'billing');
        $user = Auth::guard('web')->user();

        if($user) {
            $countries = Country::active()->get();
            return view('frontend::user.profile', compact('user', 'countries'));
        }
        else {
            return view('frontend::errors.500');
        }
    }

    /**
     * Update Profile Data
     *
     */
    public function updateProfile(UserProfileUpdateRequest $request) {
        Session::put('address_tab', 'billing');
        $user = User::find(Auth::guard('web')->id());

        if($user) {
            $message = 'Profile updated successfully';
            $user->name = $request->name;
            $user->company = $request->company;
            $user->address = $request->address;
            $user->country_id = $request->country;
            $user->email = $request->email;
            if($user->isDirty('email')) {
                $user->email_verified = 0;
                $message .= ' Please verify your email.';
            }
            $user->phone_code = $request->phone_code;
            $user->phone = $request->phone;
            if($user->isDirty('phone') || $user->isDirty('phone_code')) {
                $user->phone_verified = 0;
                $message .= ' Please verify your phone.';
            }

            $user->office_phone_code = $request->office_phone_code;
            $user->office_phone = $request->office_phone;
            if($user->isDirty('office_phone') || $user->isDirty('office_phone_code')) {
                $user->office_phone_verified = 0;
                $message .= ' Please verify your office phone.';
            }

            if ($request->hasFile('attachment')) {
                $user->deleteImage('attachment');
                $file = $request->file('attachment');
                $user->attachment = $user->uploadImage($file, $user->getImageDirectory());
            }

            if ($user->save()) {
                return to_route('user.profile')->with('success', $message);
            }
            else {
                return to_route('user.profile')->with('error', 'Something went wrong. Please try again later.');
            }
        }
        else {
            return view('frontend::errors.500');
        }
    }

    /**
     * Sending otp
     *
     */
    public function otpSend(Request $request) {
        Session::put('address_tab', 'billing');
        if(!$request->field)
            return response()->json([
                'status' => false
            ]);

        $field = $request->field;
        $user = User::find(Auth::guard('web')->id());

        if ($field == 'email') {
            $method = 3; //email
            $verification_code = mt_rand(1000, 9999);
            $identifier = $user->email;
            $user->profileOtps()->create([
                'method' => 3, // email
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);

            //sending otp to email
            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.email-otp', ['code' => $verification_code,'siteSettings'=>$siteSettings,'user'=>$user], function ($message) use ($identifier) {
                $message->to($identifier);
                $message->subject('Al Masar Al Saree Email OTP Verification');
            });
        } else {
            if($field == 'phone') {
                $identifier = $user->full_phone_number;
                $method = 1; // phone
                $verification_code = $this->sendMessage($identifier, 'Al Masar Al Saree Phone Verification Code is: ');
            }

            else {
                $identifier = $user->full_office_phone_number;
                $method = 2; // office phone
                $verification_code = $this->sendMessage($identifier, 'Al Masar Al Saree Office Phone Verification Code is: ');
            }

            $user->profileOtps()->create([
                'method' => $method,
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);
        }

        Session::put('profile_field', $field);
        Session::put('profile_method', $method);
        Session::put('profile_identifier', $identifier);

        return response()->json([
            'status' => true,
            'url' => route('user.profile.otp-verification.form'),
        ]);
    }

    /**
     * Resend otp to the requested field
     *
     */
    public function otpResend() {
        Session::put('address_tab', 'billing');
        $user = User::find(Auth::guard('web')->id());

        if (!$user) {
            return response()->json([
                'status' => false,
                'url' => route('user.profile'),
            ]);
        }

        $field = Session::get('profile_field');
        $method = Session::get('profile_method');
        $identifier = Session::get('profile_identifier');

        if (!$field || !$method || !$identifier) {
            session()->flash('error', 'Something went wrong. Please try again later.');
            return response()->json([
                'status' => false,
                'url' => route('user.profile'),
                'message' => ''
            ]);
        }

        $lastOtp = ProfileOtp::where('user_id', $user->id)
            ->where('method', $method)
            ->where('identifier', $identifier)
            ->where('used', false)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOtp && now()->diffInMinutes($lastOtp->created_at) < 1) {
            // An OTP was sent within the last minute, show an error or handle as needed
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Please wait sometime before requesting a new OTP'
            ]);
        }

        $user->profileOtps()->where('used', 1)->delete();

        if ($field == 'email') {
            $method = 3; //email
            $verification_code = mt_rand(1000, 9999);
            $identifier = $user->email;
            $user->profileOtps()->create([
                'method' => 3, // email
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);

            //sending otp to email
            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.email-otp', ['code' => $verification_code,'siteSettings'=>$siteSettings,'user'=>$user], function ($message) use ($identifier) {
                $message->to($identifier);
                $message->subject('Al Masar Al Saree Email OTP Verification');
            });
        } else {
            if($field == 'phone') {
                $identifier = $user->full_phone_number;
                $method = 1; // phone
                $verification_code = $this->sendMessage($identifier, 'Al Masar Al Saree Resented Phone Verification Code is: ');
            }

            else {
                $identifier = $user->full_office_phone_number;
                $method = 2; // office phone
                $verification_code = $this->sendMessage($identifier, 'Al Masar Al Saree Resented Office Phone Verification Code is: ');
            }

            $user->profileOtps()->create([
                'method' => $method,
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);
        }

        return response()->json([
            'status' => true,
            'url' => '',
            'message' => 'A new OTP has been sent to '. str_replace('_',' ',ucwords($field,'_')) . ': ' . $identifier . '.'
        ]);
    }

    /**
     * Show the otp verification form
     *
     */
    public function otpVerificationForm()
    {
        Session::put('address_tab', 'billing');
        $field = Session::get('profile_field');
        $method = Session::get('profile_method');
        $identifier = Session::get('profile_identifier');

        $latest_otp = ProfileOtp::where('method', $method)->where('identifier', $identifier)
                            ->where('user_id', Auth::guard('web')->id())->where('used', false)
                            ->orderBy('id', 'desc')
                            ->first();
        if(!$latest_otp)
            return to_route('user.profile');

        return view('frontend::user.otp-verification', compact('field', 'method', 'identifier'));
    }

    public function verifyOtp(Request $request) {
        Session::put('address_tab', 'billing');
        $request->validate([
            'otp1' => 'required|digits_between:1,1|integer',
            'otp2' => 'required|digits_between:1,1|integer',
            'otp3' => 'required|digits_between:1,1|integer',
            'otp4' => 'required|digits_between:1,1|integer'
        ]);

        $submittedOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
        $submittedOtp = (int)$submittedOtp;
        $user = User::find(Auth::guard('web')->id());

        if (!$user) {
            return response()->json([
                'status' => false,
                'url' => route('user.profile'),
            ]);
        }

        $field = Session::get('profile_field');
        $method = Session::get('profile_method');
        $identifier = Session::get('profile_identifier');

        if (!$field || !$method || !$identifier) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.profile'),
                'message' => ''
            ]);
        }

        $otp = ProfileOtp::where('user_id', $user->id)
            ->where('method', $method)
            ->where('identifier', $identifier)
            ->where('used', false)
            ->orderBy('id', 'desc')
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Wrong OTP. If you don\' get the OTP, Please try Resend OTP.'
            ]);
        }

        $verify_field = $field.'_verified';

        if ($submittedOtp == $otp->code) {
            $user->$verify_field = 1;
            $user->save();
            $otp->used = 1;
            $otp->save();
            Session::forget('profile_field');
            Session::forget('profile_method');
            Session::forget('profile_identifier');
            session()->flash('success', str_replace('_',' ',ucwords($field,'_')) . ' verification completed');
            return response()->json([
                'status' => true,
                'url' => route('user.profile'),
                'message' => ''
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'You have entered the wrong OTP!. Please enter correct one or  Please try Resend OTP.'
            ]);
        }
    }

    public function sendMessage($phone, $message)
    {
        $phone_verification_code = FrontendHelper::sendMessage($phone, $message);

        return $phone_verification_code;
    }

    /**
     * Add Address
     *
     */
    public function newAddress()
    {
        $shipping_addresses = UserAddress::where('user_id', Auth::guard('web')->id())->where('type', 2)->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')->get();
        $billing_addresses = UserAddress::where('user_id', Auth::guard('web')->id())->where('type', 1)->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')->get();
        return view('frontend::user.address-listing', compact('shipping_addresses', 'billing_addresses'));
    }

    /**
     * Add Billing Address
     *
     */
    public function addBillingAddress()
    {
        Session::put('address_tab', 'billing');
        $countries = Country::active()->get();
        return view('frontend::user.add-billing-address', compact('countries'));
    }

    /**
     * Store Billing Address
     *
     */
    public function storeBillingAddress(UserAddressRequest $request, UserAddress $billing_address)
    {
        Session::put('address_tab', 'billing');
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
        $billing_address->email              = $request->email;
        $billing_address->phone_number      = $request->phone_number;

        if ($existingBillingAddress) {
            $existingBillingAddress->is_default = 0;
            $existingBillingAddress->save();
        }

        $billing_address->is_default        = 1;

        if ($billing_address->save()) {
            if ($request->ajax()) {
                $user = $billing_address->user;
                $billing_addresses = $user->billingAddresses;
                $addresses = View::make('frontend::includes.billing-address-list', compact('billing_addresses'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Billing Address has been Added Successfully',
                    'address' => $addresses
                ]);
            } else
                return redirect()->route('address')->with('success', 'Billing Address has been Added Successfully!');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false
                ]);
            } else
                return redirect()->route('address')->with('error', 'Failed to Add Billing Address');
        }
    }

    /**
     * Edit Billing Address
     *
     */
    public function editBillingAddress($id)
    {
        Session::put('address_tab', 'billing');
        try {
            $billing_address    = UserAddress::find(decrypt($id));
            $countries         = Country::active()->get();
            $states             = State::active()->where('country_id', $billing_address->country_id)->get();
            return view('frontend::user.edit-billing-address', compact('billing_address', 'countries', 'states'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Update Billing Address
     *
     */
    public function updateBillingAddress(UserAddressRequest $request, $id)
    {
        Session::put('address_tab', 'billing');
        $billing_address            = UserAddress::find($id);
        $existingBillingAddress     = UserAddress::where('user_id', Auth::guard('web')->id())
            ->where('id', '!=', $id)
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
        $billing_address->email             = $request->email;
        $billing_address->phone_number      = $request->phone_number;

        if ($existingBillingAddress) {
            $existingBillingAddress->is_default = 0;
            $existingBillingAddress->save();
        }

        $billing_address->is_default        = 1;

        if ($billing_address->save()) {
            if ($request->ajax()) {
                $user = $billing_address->user;
                $billing_addresses = $user->billingAddresses;
                $addresses = View::make('frontend::includes.billing-address-list', compact('billing_addresses'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Billing Address has been Updated Successfully',
                    'address' => $addresses
                ]);
            } else
                return redirect()->route('address')->with('success', 'Billing Address has been Updated Successfully!');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false
                ]);
            } else
                return redirect()->route('address')->with('error', 'Failed to Update Billing Address');
        }
    }

    /**
     * Add Shipping Address
     *
     */
    public function addShippingAddress()
    {
        Session::put('address_tab', 'shipping');
        $countries = Country::active()->get();
        return view('frontend::user.add-shipping-address', compact('countries'));
    }

    /**
     * Store Shipping Address
     *
     */
    public function storeShippingAddress(UserAddressRequest $request)
    {
        Session::put('address_tab', 'shipping');
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
        $shipping_address->email             = $request->email;
        $shipping_address->phone_number      = $request->phone_number;


        if ($existingShippingAddress) {
            $existingShippingAddress->is_default = 0;
            $existingShippingAddress->save();
        }
        $shipping_address->is_default        = 1;

        if ($shipping_address->save()) {
            if ($request->ajax()) {
                $user = $shipping_address->user;
                $shipping_addresses = $user->shippingAddresses;
                $addresses = View::make('frontend::includes.shipping-address-list', compact('shipping_addresses'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Shipping Address has been Added Successfully',
                    'address' => $addresses
                ]);
            } else
                return redirect()->route('address')->with('success', 'Shipping Address has been Added Successfully!');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false
                ]);
            } else
                return redirect()->route('address')->with('error', 'Failed to Add Shipping Address');
        }
    }

    /**
     * Edit Shipping Address
     *
     */
    public function editShippingAddress($id)
    {
        Session::put('address_tab', 'shipping');
        try {
            $shipping_address   = UserAddress::find(decrypt($id));
            $countries         = Country::active()->get();
            $states             = State::active()->where('country_id', $shipping_address->country_id)->get();

            return view('frontend::user.edit-shipping-address', compact('shipping_address', 'countries', 'states'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('user.dashboard');
        }
    }

    /**
     * Update Shipping Address
     *
     */
    public function updateShippingAddress(UserAddressRequest $request, $id)
    {
        Session::put('address_tab', 'shipping');
        $existingShippingAddress    = UserAddress::where('user_id', Auth::guard('web')->id())
            ->where('id', '!=', $id)
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
        $shipping_address->email             = $request->email;
        $shipping_address->phone_number      = $request->phone_number;


        if ($existingShippingAddress) {
            $existingShippingAddress->is_default = 0;
            $existingShippingAddress->save();
        }
        $shipping_address->is_default        = 1;

        if ($shipping_address->save()) {
            if ($request->ajax()) {
                $user = $shipping_address->user;
                $shipping_addresses = $user->shippingAddresses;
                $addresses = View::make('frontend::includes.shipping-address-list', compact('shipping_addresses'))->render();
                return response()->json([
                    'status' => true,
                    'message' => 'Shipping Address has been Updated Successfully',
                    'address' => $addresses
                ]);
            } else
                return redirect()->route('address')->with('success', 'Shipping Address has been Updated Successfully!');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'status' => false
                ]);
            } else
                return redirect()->route('address')->with('error', 'Failed to Update Shipping Address');
        }
    }

    /**
     * update default
     */
    public function updateDefault(Request $request)
    {
        $address = UserAddress::findOrFail($request->id);
        if ($address) {
            if ($address->is_default == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'This is already the default address'
                ]);
            }
            $existingBillingAddress = UserAddress::where('user_id', Auth::guard('web')->id())
                ->where('type', $request->type)
                ->where('is_default', 1)
                ->first();
            if ($existingBillingAddress) {
                $existingBillingAddress->is_default = 0;
                $existingBillingAddress->save();
            }
            $address->is_default = 1;
            if ($address->save()) {
                return response()->json([
                    'id' => $request->id,
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
        $page = $request->input('page');
        if(!$address)  {
            return response()->json(['success' => false, 'message' => 'No address found.']);
        }
        $type = $address->type;
        $isDefault = $address->is_default;
        $address->is_default = 0;
        $address->save();
        if ($address->delete()) {
            if($isDefault) {
                $defaultAddress = UserAddress::where('user_id', auth()->id())
                    ->where('type', $type)
                    ->where('is_default', 1)
                    ->first();
                if (!$defaultAddress) {
                    $existingAddress = UserAddress::where('user_id', auth()->id())
                        ->where('type', $type)
                        ->where('is_default', 0)
                        ->latest()
                        ->first();

                    if ($existingAddress) {
                        $existingAddress->is_default = 1;
                        if ($existingAddress->save()) {
                            $defaultId =  $existingAddress->id;
                        }
                    } else {
                        return response()->json(['success' => true, 'flag' => 1, 'message' => 'Address deleted successfully.']);
                    }
                } else {
                    $defaultId = $defaultAddress->id;
                }

                if($type == 1) {
                    $billing_addresses = $address->user->billingAddresses;
                    if($page == 'checkout')
                        $address_view = View::make('frontend::includes.billing-address-list', compact('billing_addresses'))->render();
                    else
                        $address_view = View::make('frontend::includes.billing-address-list-dashboard', compact('billing_addresses'))->render();
                }

                else {
                    $shipping_addresses = $address->user->shippingAddresses;
                    if($page == 'checkout')
                        $address_view = View::make('frontend::includes.shipping-address-list', compact('shipping_addresses'))->render();
                    else
                        $address_view = View::make('frontend::includes.shipping-address-list-dashboard', compact('shipping_addresses'))->render();
                }

                return response()->json([
                    'success' => true,
                    'type' => $type,
                    'defaultId' => $defaultId,
                    'flag' => 1,
                    'address_content' => $address_view,
                    'message' => 'Address deleted successfully.'
                ]);
            }
            return response()->json(['success' => true, 'flag' => 1, 'message' => 'Address deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'An error occurred while deleting the address.']);
    }

    /**
     * select state
     *
     */
    public function selectState(Request $request)
    {
        $states = State::where('country_id', $request->countryId)->get();
        return response()->json($states);
    }

    public function orders()
    {
        Session::put('address_tab', 'billing');
        $orders = Order::where('user_id', Auth::guard('web')->id())->latest()->get();
        $order_statuses = OrderStatus::all();
        $payment_modes = Payment::all();

        return view('frontend::user.orders', compact('orders', 'order_statuses', 'payment_modes'));
    }
    //order filter with order status and payment method
    public function orderFilter(Request $request)
    {
        $orders = Order::where('user_id', Auth::guard('web')->id())
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('order_status_id', $request->input('status'));
            })
            ->when($request->filled('payment_mode'), function ($query) use ($request) {
                $query->where('payment_id', $request->input('payment_mode'));
            })
            ->latest()->get();
        return view('frontend::includes.order-list', compact('orders'));
    }
    //order filter with order status and payment method in mob
    public function orderFilterMob(Request $request)
    {
        $orders = Order::where('user_id', Auth::guard('web')->id())
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('order_status_id', $request->input('status'));
            })
            ->when($request->filled('payment_mode'), function ($query) use ($request) {
                $query->where('payment_id', $request->input('payment_mode'));
            })
            ->latest()->get();
        return view('frontend::includes.order-list-mob', compact('orders'));
    }

    public function uploadAttachment (Request $request) {
        $rules = [
            'attachment' => 'required|max:2000|mimes:pdf,jpg,jpeg,png',
            'uid'=> 'required'
        ];

        $customMessages = [
            'attachment.required' => 'Please upload a file',
            'attachment.max' => 'The attachment size must not be greater than 2MB'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors'=> $validator->errors()]);
        }

        if($request->hasFile('attachment')) {
            $order = Order::where('uid', $request->uid)->where('user_id', Auth::guard('web')->id())->first();

            if(!$order) {
                return response()->json(['status' => false,'message'=> 'No order found']);
            }

            if($order->attachment) {
                return response()->json(['status' => false,'message'=> 'You are already uploaded the file']);
            }

            $file = $request->file('attachment');
            $order->attachment = $order->uploadImage($file, $order->getImageDirectory());
            if($order->save()) {
                return response()->json([
                    'status' => true,
                    'message'=> 'Attachment uploaded successfully',
                    'url' => Storage::url($order->attachment)
                ]);
            }
            else {
                return response()->json(['status' => false,'message'=> 'Something went wrong please try again later']);
            }
        }
        else {
            return response()->json(['status' => false]);
        }
    }
}
