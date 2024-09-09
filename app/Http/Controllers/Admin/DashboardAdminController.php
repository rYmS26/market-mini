<?php 

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Make sure this line is present
use App\Models\User; // Ensure the User model is imported
use App\Models\Product;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller {
    public function index() {
        $usersCount = User::count(); // Menghitung jumlah users
        $productCount = Product::count(); // Menghitung jumlah produk
        return view('admin.dashboard', compact('usersCount','productCount'));
    }
}
