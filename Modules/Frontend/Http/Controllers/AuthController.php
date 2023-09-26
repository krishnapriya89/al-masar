<?php

namespace Modules\Frontend\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\FrontendHelper;
use App\Models\Country;
use App\Models\SiteCommonSetting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Support\Renderable;
use Modules\Frontend\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the admin dashboard or any other authenticated page
        }

        $encryptedEmail     = Cookie::get('user_email', '');
        $encryptedPassword  = Cookie::get('user_password', '');
        $remember           = Cookie::get('user_remember', false);

        $email              = $encryptedEmail ? Crypt::decrypt($encryptedEmail) : '';
        $password           = $encryptedPassword ? Crypt::decrypt($encryptedPassword) : '';

        return view('frontend::auth.login', compact('email', 'password', 'remember'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'     => 'required',
            'otp'  => 'required'
        ],
        [
            'login' => 'The username or email field is required'
        ]);

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

    public function showRegisterForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the admin dashboard or any other authenticated page
        }

        $countries = Country::active()->get();
        return view('frontend::auth.register', compact('countries'));
    }

    public function register(UserRegisterRequest $request)
    {
        dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->company = $request->company;
        $user->address = $request->address;
        $user->country_id = $request->country;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->office_phone = $request->office_phone;

        if($request->has('attachment')) {
            $file = $request->file('attachment');
            $user->file_name = $user->uploadImage($file, $user->getImageDirectory());
        }

        if($user->save())
        {
            $email_verification_code = mt_rand(100000, 999999);
            if($user->email) {
                // $site_settings = SiteCommonSetting::first();
                Mail::send('frontend::emails.registration', compact('user', 'site_settings'), function($message) use($request){
                    $message->to($request->email);
                    $message->subject(AdminHelper::getValueByKey('website_name'). ' - Registration Successfully Done');
                });
            }
            $remember = $request->remember;
            if (Auth::guard('web')->attempt(['email' => $user->email, 'password' => $request->password, 'status' => 1], $remember) || Auth::guard('web')->attempt(['username' => $user->username, 'password' => $request->password, 'status' => 1], $remember)) {
                if ($remember) {
                    $this->setRememberMeCookie($request->email, $request->password);
                } else {
                    $this->clearRememberMeCookie();
                }

                return to_route('home')->with('success', 'Registration completed successfully');
            } else {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Some error occurred while creating account']);
        }
    }

    public function showForgotPasswordForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->intended('/'); // Redirect to the user dashboard or any other authenticated page
        }

        return view('frontend::auth.forgot_password');
    }

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email,status,1,user_type,User',
        ],
        [
            'email.exists' => 'The entered email is not exists in our record'
        ]);

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

        Mail::send('frontend::emails.forgot_password', ['token' => $token], function($message) use($request){
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

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return to_route('user.login.form')->with('success', 'Your password has been changed!');
    }

//    protected function credentials(Request $request)
//    {
//        // the value in the 'email' field in the request
//        $username = $request->get($this->username());
//
//        // check if the value is a validate email address and assign the field name accordingly
//        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? $this->username()  : 'username';
//
//        // return the credentials to be used to attempt login
//        return [
//            $field => $request->get($this->username()),
//            'password' => $request->password,
//        ];
//    }

    public function logout(Request $request)
    {
        $tempUser = session('temp_user'); // Store the value before clearing the session

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($tempUser !== null) {
            session(['temp_user' => $tempUser]); // Restore the value if it was previously set
        }

        return redirect()->intended('/');
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
