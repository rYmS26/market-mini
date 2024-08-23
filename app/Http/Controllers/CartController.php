<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Method to add items to the cart
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    // Method to remove items from the cart
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    // Method to view cart items
    public function index()
    {
        $cartItems = session()->get('cart', []);
        // Fetch product details from the database based on $cartItems
        // For simplicity, assume you have a Product model with details
        $products = \App\Models\Product::whereIn('id', array_keys($cartItems))->get();
        return view('cart.index', compact('products', 'cartItems'));
    }
}









