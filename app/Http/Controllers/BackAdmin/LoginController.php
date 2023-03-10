<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function index()
    {
        return view('backadmin.auth.login');
    }
 
    /**
     * Login user into the system
     */
    public function login(Request $req)
    {
        #validasi captcha
        // $req->validate([
        //     'g-recaptcha-response' => 'required|captcha',
        // ]);

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password, 'is_active' => 1], $req->remember)) {
            $req->session()->regenerate();
           # return redirect()->intended('backadmin/dashboard');
           return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak cocok dengan data yang ada',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect()->route('backadmin.auth.login');
    }
}
