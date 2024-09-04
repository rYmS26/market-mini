<?php

namespace App\Http\Controllers;

use App\Models\User; // Make sure to import the User model
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    public function index()
    {
        // Fetch all users (you can modify this to fetch guests or other specific users as needed)
        $guests = User::all();

        // Pass the data to the view
        return view('admin.userdetail', compact('guests'));
    }
}
