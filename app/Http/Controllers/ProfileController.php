<?php
  
  namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        if (!$user) {
            return redirect()->route('login'); // Redirect jika user tidak login
        }

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        // Menambahkan flash message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
