<?php
  
  namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the top 3 products based on some criteria, e.g., most recent
        $topProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
        
        return view('home', compact('topProducts'));
    }
}
