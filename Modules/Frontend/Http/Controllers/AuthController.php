<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\PhoneOtp;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\FrontendHelper;
use App\Models\AuthPageCommonContent;
use App\Models\LoginOtp;
use App\Models\UserEmailVerify;
use App\Models\SiteCommonContent;
use App\Models\SiteCommonSetting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Frontend\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    //login form
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the user dashboard or any other authenticated page
        }

        $encryptedEmail     = Cookie::get('al_masar_user_email', '');
        $encryptedPassword  = Cookie::get('al_masar_user_password', '');
        $remember           = Cookie::get('al_masar_user_remember', false);

        $email              = $encryptedEmail ? Crypt::decrypt($encryptedEmail) : '';
        $password           = $encryptedPassword ? Crypt::decrypt($encryptedPassword) : '';

        $auth_page_cms = AuthPageCommonContent::page('login-page')->first();

        return view('frontend::auth.login', compact('email', 'password', 'remember', 'auth_page_cms'));
    }

    //login functionality
    public function login(Request $request)
    {
        $request->validate(
            [
                'login'     => 'required'
            ],
            [
                'login' => 'This field is required'
            ]
        );

        $identifier = $request->login;

        $user = User::where('user_type', 'User')->where(function ($query) use ($identifier) {
            $query->where(DB::raw("CONCAT(phone_code, phone)"), $identifier)
                ->orWhere('email', $identifier);
            })
            ->first();

        //check user exists or not
        if (!$user)
            return redirect()->back()->withInput()->withErrors(['login' => 'The provided phone number or email does not exist.']);

        //check registration status
        $is_registration_process_completed = false;
        switch ($user->register_status) {
            case 0:
                $url = 'user.register.form';
                $message = 'You have to register your details first.';
                break;
            case 1:
                $url = 'user.show-phone-verification.form';
                $message = 'You have to verify your phone number first.';
                break;
            case 2:
                $url = 'user.show-office-phone-verification.form';
                $message = 'You have to verify your office phone number first.';
                break;
            case 3:
                $is_registration_process_completed = true;
                break;
            default:
                $url = 'user.login.form';
                $message = 'Something went wrong.';
                break;
        }

        //redirecting to the registration stage
        if (!$is_registration_process_completed) {
            $encryptedUserID = Crypt::encrypt($user->id);
            Session::put('registered_user', $encryptedUserID);
            return to_route($url)->with('error', $message);;
        }

        if ($user->phone_verified == 0) {
            $encryptedUserID = Crypt::encrypt($user->id);
            Session::put('registered_user', $encryptedUserID);
            return to_route('user.show-phone-verification.form')->with('error', 'You need to confirm your phone number.');
        }

        if ($user->office_phone_verified == 0) {
            $encryptedUserID = Crypt::encrypt($user->id);
            Session::put('registered_user', $encryptedUserID);
            return to_route('user.show-office-phone-verification.form')->with('error', 'You need to confirm your office phone number.');
        }

        if ($user->email_verified == 0)
            return redirect()->back()->withInput()->withErrors(['login' => 'You need to confirm your account. We have sent you an verification link, please check your email.']);

        if ($user->admin_verified == 0)
            return redirect()->back()->withInput()->withErrors(['login' => 'Your Registration details are not confirmed from the admin side. Please try after some time or contact Admin.']);

        if ($user->status == 0)
            return redirect()->back()->withInput()->withErrors(['login' => 'Your Account is suspended by Admin. Please contact Admin.']);

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $method = 'email';
            $verification_code = mt_rand(1000, 9999);

            $user->loginOtps()->create([
                'method' => 2, // email
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);

            //sending otp to email
            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.email-otp', ['code' => $verification_code,'siteSettings'=>$siteSettings,'user'=>$user], function ($message) use ($identifier) {
                $message->to($identifier);
                $message->subject('Al Masar Al Saree Login OTP');
            });
        } else {
            $method = 'phone';
            $verification_code = $this->sendMessage($user->full_phone_number, 'Al Masar Al Saree Login OTP is: ');

            $user->loginOtps()->create([
                'method' => 1, // phone
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);
        }

        $encryptedUserID = Crypt::encrypt($user->id);
        Session::put('login_user', $encryptedUserID);
        Session::put('login_method', $method);
        Session::put('login_identifier', $identifier);

        $auth_page_cms = AuthPageCommonContent::page('otp-page')->first();
        return view('frontend::auth.login-otp-verification', compact('method', 'identifier', 'auth_page_cms'));
    }

    //verify the login otp
    public function  verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp1' => 'required|digits_between:1,1|integer',
            'otp2' => 'required|digits_between:1,1|integer',
            'otp3' => 'required|digits_between:1,1|integer',
            'otp4' => 'required|digits_between:1,1|integer'
        ]);

        $submittedOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
        $submittedOtp = (int)$submittedOtp;

        $encryptedUserID = Session::get('login_user');
        if (!$encryptedUserID) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        }

        $userID = Crypt::decrypt($encryptedUserID) ?? false;
        if (!$userID) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        }

        $user = User::find($userID);

        if (!$user) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        }

        $method = Session::get('login_method');
        $identifier = Session::get('login_identifier');

        if (!$method || !$identifier) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        }

        $method_val = $method === 'phone' ? 1 : 2;

        $otp = LoginOtp::where('user_id', $user->id)
            ->where('method', $method_val)
            ->where('identifier', $identifier)
            ->where('used', false)
            ->orderBy('id', 'desc')
            ->first();

        if (!$otp) {
            session()->flash('error', 'Something went wrong. Please try Resend OTP.');
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => ''
            ]);
        }

        if ($submittedOtp == $otp->code) {
            $otp->used = 1;
            $otp->save();
            Auth::login($user);
            session()->flash('success', 'Login completed');
            return response()->json([
                'status' => true,
                'url' => route('user.dashboard'),
                'message' => ''
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'You have entered the wrong OTP!. Please enter correct one'
            ]);
        }
    }

    //resend login otp through ajax
    public function resendLoginOtp()
    {
        $user = $this->getLoginUserData();
        if (!$user) {
            session()->flash('error', 'You have to register your details first');
            return response()->json([
                'status' => false,
                'url' => route('user.register.form')
            ]);
        }

        $method = Session::get('login_method');
        $identifier = Session::get('login_identifier');

        if (!$method || !$identifier) {
            session()->flash('error', 'Something went wrong');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        }

        $method_val = $method === 'phone' ? 1 : 2;

        $lastOtp = LoginOtp::where('user_id', $user->id)
            ->where('method', $method_val)
            ->where('identifier', $identifier)
            ->where('used', false)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOtp && now()->diffInMinutes($lastOtp->created_at) < 1) {
            // An OTP was sent within the last minute, show an error or handle as needed
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Please wait before requesting a new OTP'
            ]);
        }

        $user->loginOtps()->delete();
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            $verification_code = mt_rand(1000, 9999);

            $user->loginOtps()->create([
                'method' => 2, // email
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);

            //sending otp to email

            Mail::send('frontend::emails.email-otp', ['code' => $verification_code], function ($message) use ($identifier) {
                $message->to($identifier);
                $message->subject('Al Masar Al Saree Login OTP');
            });
        } else {
            $verification_code = $this->sendMessage($user->full_phone_number, 'Al Masar Al Saree Resented Login OTP is: ');

            $user->loginOtps()->create([
                'method' => 1, // phone
                'identifier' => $identifier,
                'code' => $verification_code,
            ]);
        }

        return response()->json([
            'status' => true,
            'url' => '',
            'message' => 'A new OTP has been sent to '. $method . ': ' . $identifier . '.'
        ]);
    }

    //showing registration form
    public function showRegisterForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the admin dashboard or any other authenticated page
        }

        $countries = Country::active()->get();
        $auth_page_cms = AuthPageCommonContent::page('register-page')->first();
        return view('frontend::auth.register', compact('countries', 'auth_page_cms'));
    }

    //store registration data redirect to phone verification form
    public function register(UserRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->company = $request->company;
        $user->address = $request->address;
        $user->country_id = $request->country;
        $user->email = $request->email;
        $user->phone_code = $request->phone_code;
        $user->phone = $request->phone;
        $user->office_phone_code = $request->office_phone_code;
        $user->office_phone = $request->office_phone;
        $user->phone_verified = 0;
        $user->office_phone_verified = 0;
        $user->email_verified = 0;
        $user->register_status = 1; //registration completed

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $user->attachment = $user->uploadImage($file, $user->getImageDirectory());
        }

        if ($user->save()) {
            if ($user->email) {
                $token = Str::random(64);
                // Send email verification notification
                UserEmailVerify::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);
                $siteSettings = SiteCommonContent::first();

                Mail::send('frontend::emails.email-verify', ['token' => $token,'user' => $user,'siteSettings'=>$siteSettings], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
            }

            $siteSettings = SiteCommonContent::first();
            Mail::send('frontend::emails.new-user', ['user' => $user, 'siteSettings'=>$siteSettings], function ($message) use ($siteSettings, $user) {
                $message->to($siteSettings->enquiry_receive_email);
                $message->subject('New User Registered');
                if($user->attachment) {
                    $message->attach(public_path('storage/'.$user->attachment));
                }
            });

            $encryptedUserID = Crypt::encrypt($user->id);
            Session::put('registered_user', $encryptedUserID);

            return to_route('user.show-phone-verification.form')->with('success', 'Your registration was successful.');
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Some error occurred while creating account']);
        }
    }

    //showing phone otp verification form
    public function  showPhoneVerificationForm()
    {
        $user = $this->getRegisteredUserData();

        if ($user) {
            if ($user->phone_verified == 0) {

                $phoneNumber = $user->full_phone_number;
                //send otp
                $phone_verification_code = $this->sendMessage($phoneNumber, 'Al Masar Al Saree Phone Verification Code is: ');
                $user->phoneOtps()->delete();
                $user->phoneOtps()->create([
                    'code' => $phone_verification_code,
                    'phone' => $phoneNumber,
                ]);

                $auth_page_cms = AuthPageCommonContent::page('otp-page')->first();
                return view('frontend::auth.phone-verification', compact('phoneNumber', 'auth_page_cms'));
            } {
                return to_route('user.show-office-phone-verification.form')->with('warning', 'You have already verified this ' . $user->full_phone_number . ' phone number. Please verify ' . $user->full_office_phone_number . ' this number.');
            }
        } else {
            return to_route('user.register.form')->with('error', 'You have to register your details first!');
        }
    }

    //verifying phone otp through ajax
    public function verifyPhone(Request $request)
    {
        $request->validate([
            'otp1' => 'required|digits_between:1,1|integer',
            'otp2' => 'required|digits_between:1,1|integer',
            'otp3' => 'required|digits_between:1,1|integer',
            'otp4' => 'required|digits_between:1,1|integer'
        ]);

        $submittedOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
        $submittedOtp = (int)$submittedOtp;

        $user = $this->getRegisteredUserData();

        if (!$user) {
            session()->flash('success', 'You have to register your details first');
            return response()->json([
                'status' => false,
                'url' => route('user.register.form'),
                // 'message' => 'Some error occurred while verifying please try after some time'
            ]);
        }

        if ($user->phone_verified == 1) {
            session()->flash('success', 'You have already verified this ' . $user->full_phone_number . ' phone number. Please verify ' . $user->full_office_phone_number . ' this number.');
            return response()->json([
                'status' => false,
                'url' => route('user.show-office-phone-verification.form'),
                // 'message' => 'You have already verified this ' . $user->full_phone_number . ' phone number. Please verify ' . $user->full_office_phone_number . ' this number.'
            ]);
        }

        $otp = PhoneOtp::where('user_id', $user->id)
            ->where('phone', $user->full_phone_number)
            ->where('used', false)
            ->latest()
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Something went wrong please try Resend OTP.'
            ]);
        }

        if ($submittedOtp == $otp->code) {

            $otp->used = true;
            $otp->save();

            $user->phone_verified = 1;
            $user->register_status = 2; //phone verification completed
            $user->save();
            session()->flash('success', $user->full_phone_number . ' number verified successfully');

            return response()->json([
                'status' => true,
                'url' => route('user.show-office-phone-verification.form'),
                // 'message' => $user->full_phone_number. ' number verified successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'You have entered the wrong OTP!. Please enter correct one'
            ]);
        }
    }

    //showing office phone otp verification form
    public function  showOfficePhoneVerificationForm()
    {
        $user = $this->getRegisteredUserData();

        if ($user) {

            if ($user->phone_verified != 1) {
                return to_route('user.show-phone-verification.form')->with('warning', 'You have to verify this ' . $user->full_phone_number . ' number first.');
            }

            if ($user->office_phone_verified != 1) {

                //sending phone otp
                $phone_verification_code = $this->sendMessage($user->full_office_phone_number, 'Al Masar Al Saree Office Phone Verification Code is: ');
                $user->phoneOtps()->delete();
                $user->phoneOtps()->create([
                    'code' => $phone_verification_code,
                    'phone' => $user->full_office_phone_number,
                ]);

                $auth_page_cms = AuthPageCommonContent::page('otp-page')->first();
                return view('frontend::auth.office-phone-verification', compact('user', 'auth_page_cms'));
            } else {
                return to_route('user.login.form')->with('warning', 'You have already verified this ' . $user->full_phone_number . ' phone number. Please login.');
            }
        } else {
            return to_route('user.register.form')->with('error', 'You have to register your details first!');
        }
    }

    //verifying office phone otp through ajax
    public function verifyOfficePhone(Request $request)
    {
        $request->validate([
            'otp1' => 'required|digits_between:1,1|integer',
            'otp2' => 'required|digits_between:1,1|integer',
            'otp3' => 'required|digits_between:1,1|integer',
            'otp4' => 'required|digits_between:1,1|integer'
        ]);

        $submittedOtp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
        $submittedOtp = (int)$submittedOtp;

        $user = $this->getRegisteredUserData();

        if (!$user) {
            session()->flash('error', 'You have to register your details first');
            return response()->json([
                'status' => false,
                'url' => route('user.register.form'),
                // 'message' => 'Some error occurred while verifying please try after some time'
            ]);
        }

        if ($user->phone_verified == 0) {
            session()->flash('error', 'You have to verify this ' . $user->full_phone_number . ' number first.');
            return response()->json([
                'status' => false,
                'url' => route('user.show-phone-verification.form'),
                // 'message' => 'You have already verified this ' . $user->full_phone_number . ' phone number. Please verify ' . $user->full_office_phone_number . ' this number.'
            ]);
        }

        if ($user->office_phone_verified == 1) {
            session()->flash('error', 'You have already verified this ' . $user->full_office_phone_number . ' phone number');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                // 'message' => 'You have already verified this ' . $user->full_phone_number . ' phone number. Please verify ' . $user->full_office_phone_number . ' this number.'
            ]);
        }

        $otp = PhoneOtp::where('user_id', $user->id)
            ->where('phone', $user->full_office_phone_number)
            ->where('used', false)
            ->latest()
            ->first();

        if (!$otp) {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Something went wrong please try Resend OTP.'
            ]);
        }

        if ($submittedOtp == $otp->code) {

            $otp->used = true;
            $otp->save();

            $user->office_phone_verified = 1;
            $user->register_status = 3; //phone verification completed
            $user->save();
            session()->forget('registered_user');
            $success_message = $user->full_office_phone_number . ' number verified successfully';
            if($user->email_verified == 0) {
                $success_message .= '. Kindly verify the email id as well. A mail is been sent to your registered mail id.';
            }
            if($user->admin_verified == 0) {
                $success_message .= 'And kindly wait for the admin approval.';
            }
            session()->flash('success',  $success_message);
            return response()->json([
                'status' => true,
                'url' => route('user.login.form'),
                'message' => ''
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'You have entered the wrong OTP!. Please enter correct one'
            ]);
        }
    }

    //email verification using token
    public function verifyEmail($token)
    {
        $verifyUser = UserEmailVerify::where('token', $token)->latest()->first();

        $message_type = 'error';
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();
                $message_type = 'success';
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message_type = 'warning';
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return to_route('user.login.form')->with($message_type, $message);
    }

    //resend otp through ajax
    public function resendOtp()
    {
        $user = $this->getRegisteredUserData();
        if (!$user) {
            session()->flash('error', 'You have to register your details first');
            return response()->json([
                'status' => false,
                'url' => route('user.register.form')
            ]);
        }

        $phone = '';

        //check currently in which stage is user
        if ($user->register_status == 1) {
            //check already verified
            if ($user->phone_verified == 1) {
                session()->flash('error', 'You have already verified ' . $user->full_phone_number . 'number');
                return response()->json([
                    'status' => false,
                    'url' => route('user.show-office-phone-verification.form')
                ]);
            } else {
                $phone = $user->full_phone_number;
            }
        } elseif ($user->register_status == 2) {
            if ($user->office_phone_verified == 1) {
                session()->flash('error', 'You have already verified ' . $user->full_office_phone_number . 'number');
                return response()->json([
                    'status' => false,
                    'url' => route('user.login.form')
                ]);
            } else {
                $phone = $user->full_office_phone_number;
            }
        } else {
            return response()->json([
                'status' => false,
                'url' => route('user.login.form')
            ]);
        }

        if ($phone == '') {
            return response()->json([
                'status' => false,
                'url' => route('user.login.form')
            ]);
        }

        $lastOtp = PhoneOtp::where('phone', $phone)->where('used', false)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOtp && now()->diffInMinutes($lastOtp->created_at) < 1) {
            // An OTP was sent within the last minute, show an error or handle as needed
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'Please wait before requesting a new OTP'
            ]);
        }

        $phone_verification_code = $this->sendMessage($phone, 'Al Masar Al Saree Phone Verification Code is: ');
        $user->phoneOtps()->delete();
        $user->phoneOtps()->create([
            'code' => $phone_verification_code,
            'phone' => $phone,
        ]);

        return response()->json([
            'status' => true,
            'url' => '',
            'message' => 'A new OTP has been sent to this number: ' . $phone . '.'
        ]);
    }

    public function sendMessage($phone, $message)
    {
        // $lastSentTime = PhoneOtp::where('phone', $phone)->latest()->first();

        $phone_verification_code = FrontendHelper::sendMessage($phone, $message);

        return $phone_verification_code;
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }

    //returning the data of user, id was stored in the registration process
    protected function getRegisteredUserData()
    {
        $encryptedUserID = Session::get('registered_user');
        if (!$encryptedUserID) {
            return false;
        }

        $userID = Crypt::decrypt($encryptedUserID) ?? false;
        if (!$userID) {
            return false;
        }

        $user = User::find($userID);

        if ($user)
            return $user;
        else
            return false;
    }

    //returning the data of user, id was stored in the registration process
    protected function getLoginUserData()
    {
        $encryptedUserID = Session::get('login_user');
        if (!$encryptedUserID) {
            return false;
        }

        $userID = Crypt::decrypt($encryptedUserID) ?? false;
        if (!$userID) {
            return false;
        }

        $user = User::find($userID);

        if ($user)
            return $user;
        else
            return false;
    }
}
