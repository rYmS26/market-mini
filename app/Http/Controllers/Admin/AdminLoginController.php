<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController; // Import the base controller class
use Session;

class AdminLoginController extends BaseController
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.adminlogin');
    }

    public function actionadmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('error', 'Email atau Password Salah');
            return redirect()->route('admin.adminlogin');
        }
    }

    public function actionlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.adminlogin'); // Redirect to the admin login page
    }
}
