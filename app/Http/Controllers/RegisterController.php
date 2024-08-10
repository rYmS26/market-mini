<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        // Generate verification key
        $str = Str::random(100);

        // Buat user baru
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'verify_key' => $str,
            'active' => 0 // Mengatur status aktif menjadi 0 (belum diverifikasi)
        ]);

        // Siapkan detail email
    }
}
