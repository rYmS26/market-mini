<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|max:255',
    ]);

    $str = Str::random(100);

    $user = User::create([
        'email' => $request->email,
        'username' => $request->username,
        'name' => $request->username, // Assuming 'name' should be the same as 'username'
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'verify_key' => $str
    ]);

    $details = [
        'username' => $request->username,
        'role' => $request->role,
        'website' => 'www.ayongoding.com',
        'datetime' => date('Y-m-d H:i:s'),
        'url' => request()->getHttpHost().'/register/verify/'.$str
    ];

    Mail::to($request->email)->send(new MailSend($details));

    Session::flash('message', 'Link verifikasi telah dikrim ke Email Anda. Silahkan Cek Email Anda untuk Mengaktifkan Akun');
    return redirect('register');
}

    public function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')
                    ->where('verify_key', $verify_key)
                    ->exists();
        
        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)
            ->update([
                'active' => 1
            ]);
            
            return "Verifikasi Berhasil. Akun Anda sudah aktif.";
        }else{
            return "Key tidak valid!";
        }
    }
}
