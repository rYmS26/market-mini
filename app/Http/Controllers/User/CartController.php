<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
class CartController extends BaseController
{
    // Method to add items to the cart
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        // Validate that the product ID is valid
        if (!Product::find($id)) {
            return redirect()->route('cart')->withErrors(['error' => 'Invalid product ID.']);
        }

        // Increase quantity if item already exists in the cart
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        // Update the cart in the session
        session()->put('cart', $cart);

        // Redirect with a success message
        return redirect()->route('cart')->with('success', 'Item added to cart.');
    }

    // Method to remove items from the cart
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');

        // Remove item from the cart if it exists
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // Redirect with a success message
        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }

    // Method to update item quantity
    public function updateQuantity(Request $request)
{
    $cart = session()->get('cart', []);
    $id = $request->input('id');
    $quantity = $request->input('quantity');

    if ($quantity <= 0) {
        // Remove item from cart if quantity is zero or less
        unset($cart[$id]);
    } else {
        // Update quantity
        $cart[$id] = $quantity;
    }

    session()->put('cart', $cart);

    return response()->json([
        'success' => true,
        'message' => 'Quantity updated successfully.'
    ]);
}


    // Method to view cart items
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        // Convert cart items to a Collection
        $cartItemsCollection = collect($cartItems);

        // Fetch product details from the database based on cart items
        $productIds = array_keys($cartItems);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Calculate the total amount for each product in the cart
        $totalAmount = $cartItemsCollection->map(function($quantity, $id) use ($products) {
            $product = $products->get($id);
            return $product ? $product->price * $quantity : 0;
        })->sum();

        return view('cart.index', compact('products', 'cartItems', 'totalAmount'));
    }

    public function addToCart(Request $request)
    {
        // Ambil ID dan quantity dari request
        $id = $request->input('id');
        $quantity = $request->input('quantity', 1); // Default quantity = 1 jika tidak ada

        // Ambil cart dari session, atau buat array kosong jika belum ada
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di cart
        if (isset($cart[$id])) {
            // Jika ada, tambahkan kuantitas yang baru ke kuantitas yang sudah ada
            $cart[$id] += $quantity;
        } else {
            // Jika belum ada, tambahkan produk dengan kuantitas yang baru
            $cart[$id] = $quantity;
        }

        // Simpan kembali cart ke session
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Product added to cart');
    }

}
