<?php

namespace App\Http\Controllers\Admin;

use App\Models\User; // Ensure the User model is imported
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Correctly import the base Controller class

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
