<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/al-masar-admin-auth'); // Redirect to the admin dashboard or any other authenticated page
        }

        $encryptedEmail     = Cookie::get('al_masar_email', '');
        $encryptedPassword  = Cookie::get('al_masar_password', '');
        $remember           = Cookie::get('al_masar_remember', false);

        $email              = $encryptedEmail ? Crypt::decrypt($encryptedEmail) : '';
        $password           = $encryptedPassword ? Crypt::decrypt($encryptedPassword) : '';

        return view('admin::auth.login', compact('email', 'password', 'remember'));
    }

    public function login(Request $request)
    {

        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $credentials    = $request->only('email', 'password');
        $remember       = $request->filled('remember');

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1, 'user_type' => 'Admin'], $remember)) {
            if ($remember) {
                $this->setRememberMeCookie($request->email, $request->password);
            } else {
                $this->clearRememberMeCookie();
            }

            return redirect()->intended('al-masar-admin-auth');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }

    private function setRememberMeCookie($email, $password)
    {
        $encryptedEmail     = encrypt($email);
        $encryptedPassword  = encrypt($password);

        Cookie::queue('al_masar_email', $encryptedEmail, 43200); // Expires in 30 days
        Cookie::queue('al_masar_password', $encryptedPassword, 43200); // Expires in 30 days
        Cookie::queue('al_masar_remember', true, 43200); // Expires in 30 days
    }

    private function clearRememberMeCookie()
    {
        Cookie::queue(Cookie::forget('al_masar_email'));
        Cookie::queue(Cookie::forget('al_masar_password'));
        Cookie::queue(Cookie::forget('al_masar_remember'));
    }
}
