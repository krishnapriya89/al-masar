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

        $encryptedEmail     = Cookie::get('user_email', '');
        $encryptedPassword  = Cookie::get('user_password', '');
        $remember           = Cookie::get('user_remember', false);

        $email              = $encryptedEmail ? Crypt::decrypt($encryptedEmail) : '';
        $password           = $encryptedPassword ? Crypt::decrypt($encryptedPassword) : '';

        return view('frontend::auth.login', compact('email', 'password', 'remember'));
    }

    //login functionality
    public function login(Request $request)
    {
        $request->validate(
            [
                'login'     => 'required',
                'otp'  => 'required'
            ],
            [
                'login' => 'The username or email field is required'
            ]
        );

        $remember       = $request->filled('remember');

        if (Auth::guard('web')->attempt([$this->username() => $request->login, 'otp' => $request->otp, 'status' => 1, 'user_type' => 'User'], $remember)) {
            if ($remember) {
                $this->setRememberMeCookie($request->login, $request->password);
            } else {
                $this->clearRememberMeCookie();
            }

            return to_route('home')->with('success', 'Logged successfully');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
        }
    }

    //showing registration form
    public function showRegisterForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the admin dashboard or any other authenticated page
        }

        //use in login case
        // $user = $this->getRegisteredUserData();
        // if ($user) {
        //     switch ($user->register_status) {
        //         case 0:
        //             $url = 'user.register.form';
        //             break;
        //         case 1:
        //             $url = 'user.show-phone-verification.form';
        //             break;
        //         case 2:
        //             $url = 'user.show-office-phone-verification.form';
        //             break;
        //         case 3:
        //             $url = 'user.login.form';
        //             break;
        //         default:
        //             $url = 'user.login.form';
        //             break;
        //     }

        //     return to_route($url);
        // }

        $countries = Country::active()->get();
        return view('frontend::auth.register', compact('countries'));
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
        $user->phone = $request->phone;
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

                Mail::send('frontend::emails.email-verify', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });
            }

            $encryptedUserID = Crypt::encrypt($user->id);
            Session::put('registered_user', $encryptedUserID);

            return to_route('user.show-phone-verification.form')->with('success', 'Your registration was successful.');
        } else {
            return redirect()->back()->withErrors(['email' => 'Some error occurred while creating account']);
        }
    }

    //showing phone otp verification form
    public function  showPhoneVerificationForm()
    {
        $user = $this->getRegisteredUserData();

        if ($user) {
            if ($user->phone_verified == 0) {

                $phoneNumber = $user->phone;
                //send otp
                $phone_verification_code = $this->sendOtp($phoneNumber);
                $user->phoneOtps()->delete();
                $user->phoneOtps()->create([
                    'code' => $phone_verification_code,
                    'phone' => $phoneNumber,
                ]);

                return view('frontend::auth.phone-verification', compact('phoneNumber', 'phone_verification_code'));
            } {
                return to_route('user.show-office-phone-verification.form')->with('warning', 'You have already verified this ' . $user->phone . ' phone number. Please verify ' . $user->office_phone . ' this number.');
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
            session()->flash('success', 'You have already verified this ' . $user->phone . ' phone number. Please verify ' . $user->office_phone . ' this number.');
            return response()->json([
                'status' => false,
                'url' => route('user.show-office-phone-verification.form'),
                // 'message' => 'You have already verified this ' . $user->phone . ' phone number. Please verify ' . $user->office_phone . ' this number.'
            ]);
        }

        $otp = PhoneOtp::where('user_id', $user->id)
            ->where('phone', $user->phone)
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
            session()->flash('success', $user->phone . ' number verified successfully');

            return response()->json([
                'status' => true,
                'url' => route('user.show-office-phone-verification.form'),
                // 'message' => $user->phone. ' number verified successfully'
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
                return to_route('user.show-phone-verification.form')->with('warning', 'You have to verify this ' . $user->phone . ' number first.');
            }

            if ($user->office_phone_verified != 1) {

                //sending phone otp
                $phone_verification_code = $this->sendOtp($user->office_phone);
                $user->phoneOtps()->delete();
                $user->phoneOtps()->create([
                    'code' => $phone_verification_code,
                    'phone' => $user->office_phone,
                ]);

                return view('frontend::auth.office-phone-verification', compact('user', 'phone_verification_code'));
            } else {
                return to_route('user.login.form')->with('warning', 'You have already verified this ' . $user->phone . ' phone number. Please login.');
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
            session()->flash('success', 'You have to register your details first');
            return response()->json([
                'status' => false,
                'url' => route('user.register.form'),
                // 'message' => 'Some error occurred while verifying please try after some time'
            ]);
        }

        if ($user->phone_verified == 0) {
            session()->flash('success', 'You have to verify this ' . $user->phone . ' number first.');
            return response()->json([
                'status' => false,
                'url' => route('user.show-phone-verification.form'),
                // 'message' => 'You have already verified this ' . $user->phone . ' phone number. Please verify ' . $user->office_phone . ' this number.'
            ]);
        }

        if ($user->office_phone_verified == 1) {
            session()->flash('success', 'You have already verified this ' . $user->office_phone . ' phone number. Please verify ' . $user->office_phone . ' this number.');
            return response()->json([
                'status' => false,
                'url' => route('user.login.form'),
                // 'message' => 'You have already verified this ' . $user->phone . ' phone number. Please verify ' . $user->office_phone . ' this number.'
            ]);
        }

        $otp = PhoneOtp::where('user_id', $user->id)
            ->where('phone', $user->office_phone)
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
            session()->flash('success', $user->office_phone . ' number verified successfully');

            return response()->json([
                'status' => true,
                'url' => route('user.login.form'),
                // 'message' => $user->phone. ' number verified successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'url' => '',
                'message' => 'You have entered the wrong OTP!. Please enter correct one'
            ]);
        }
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
            if($user->phone_verified == 1) {
                session()->flash('error', 'You have already verified ' . $user->phone . 'number');
                return response()->json([
                    'status' => false,
                    'url' => route('user.show-office-phone-verification.form')
                ]);
            }
            else {
                $phone = $user->phone;
            }
        } elseif($user->register_status == 2) {
            if($user->office_phone_verified == 1) {
                session()->flash('error', 'You have already verified ' . $user->office_phone . 'number');
                return response()->json([
                    'status' => false,
                    'url' => route('user.login.form')
                ]);
            }
            else {
                $phone = $user->office_phone;
            }
        }
        else{
            return response()->json([
                'status' => false,
                'url' => route('user.login.form')
            ]);
        }

        if($phone == '') {
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

        $phone_verification_code = $this->sendOtp($phone);
        $user->phoneOtps()->delete();
        $user->phoneOtps()->create([
            'code' => $phone_verification_code,
            'phone' => $phone,
        ]);

        return response()->json([
            'status' => true,
            'otp' => $phone_verification_code,
            'url' => '',
            'message' => 'A new OTP has been sent to this number: ' . $phone . '.'
        ]);
    }

    public function sendOtp($phone)
    {

        // $lastSentTime = PhoneOtp::where('phone', $phone)->latest()->first();

        $phone_verification_code = FrontendHelper::sendOtp($phone);

        return $phone_verification_code;
    }

    public function verifyEmail($token)
    {
        $verifyUser = UserEmailVerify::where('token', $token)->latest()->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return to_route('user.login.form')->with('message', $message);
    }

    public function showForgotPasswordForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the user dashboard or any other authenticated page
        }

        return view('frontend::auth.forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email,status,1,user_type,User',
            ],
            [
                'email.exists' => 'The entered email is not exists in our record'
            ]
        );

        $password_resets = DB::table('password_reset_tokens')->where('email', $request->email)->latest()->first();
        $date = Carbon::now();
        if ($password_resets && $date->diff(Carbon::parse($password_resets->created_at))->i <= 10) {
            return back()->with('error', 'We have already e-mailed your password reset link. If you don\'t get it try after some time.');
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('frontend::emails.forgot_password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function username()
    {
        $field = filter_var(request()->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => request()->input('login')]);
        return $field;
    }

    public function showResetPasswordForm($token)
    {
        return view('frontend::auth.reset_password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return to_route('user.login.form')->with('success', 'Your password has been changed!');
    }

    public function logout(Request $request)
    {
        $tempUser = session()->get('temp_user'); // Store the value before clearing the session

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($tempUser !== null) {
            session(['temp_user' => $tempUser]); // Restore the value if it was previously set
        }

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

    private function setRememberMeCookie($email, $password)
    {
        $encryptedEmail     = encrypt($email);
        $encryptedPassword  = encrypt($password);

        Cookie::queue('user_email', $encryptedEmail, 43200); // Expires in 30 days
        Cookie::queue('user_password', $encryptedPassword, 43200); // Expires in 30 days
        Cookie::queue('user_remember', true, 43200); // Expires in 30 days
    }

    private function clearRememberMeCookie()
    {
        Cookie::queue(Cookie::forget('user_email'));
        Cookie::queue(Cookie::forget('user_password'));
        Cookie::queue(Cookie::forget('user_remember'));
    }
}
