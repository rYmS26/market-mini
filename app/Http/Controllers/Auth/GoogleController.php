<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            Log::info('Google User Data', ['user' => $user]);

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                Auth::login($finduser);
                Log::info('Existing user logged in', ['user_id' => $finduser->id]);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => Str::slug($user->name),  // Username can be the same for different users
                    'google_id' => $user->id,
                    'password' => encrypt('my-google'),
                    'role' => 'guest'
                ]);

                Auth::login($newUser);
                Log::info('New user created and logged in', ['user_id' => $newUser->id]);
            }

            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('Google Login Error', ['error' => $e->getMessage()]);
            return redirect()->route('login')->withErrors('Error during Google login.');
        }
    }
}