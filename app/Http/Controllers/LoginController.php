<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        // Jika sudah login, arahkan ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Tampilkan halaman login jika belum login
        return view('login');
    }

    public function actionlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            Session::flash('error', 'Email atau Password Salah');
            return redirect()->route('login');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect()->route('home'); // Arahkan ke halaman home setelah logout
    }
}
