<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction; // Import your Transaction model
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Correctly import the base Controller class

class TransactionController extends Controller
{
    public function index()
    {
        // Fetch all transactions (or apply any necessary filters)
        $transactions = Transaction::all();

        // Pass the data to the view
        return view('admin.infotransaction', compact('transactions'));
    }
}
