<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductUserController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query(); // Apply filtering
    if ($request->has('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }
    if ($request->has('price_min')) {
        $query->where('price', '>=', $request->input('price_min'));
    }
    if ($request->has('price_max')) {
        $query->where('price', '<=', $request->input('price_max'));
    }

        $products = $query->paginate(8); // 12 products per page
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle file upload
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/photos', $filename);
        $photoUrl = Storage::url('photos/' . $filename);
    }

    // Create product with photo URL
    Product::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'photo_url' => $photoUrl
    ]);

    return redirect()->route('admin.products.index');
}


public function show($id)
{
    $product = Product::find($id);

    // Contoh untuk mendapatkan produk lain (produk yang berbeda dengan yang sedang dilihat)
    $relatedProducts = Product::where('id', '!=', $product->id)
                              ->inRandomOrder()  // Untuk produk acak
                              ->take(12)  // Batasi 4 produk
                              ->get();

    return view('products.show', compact('product', 'relatedProducts'));
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::findOrFail($id);

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($product->photo_url) {
                $oldPhoto = str_replace('/storage/', 'public/', $product->photo_url);
                if (Storage::exists($oldPhoto)) {
                    Storage::delete($oldPhoto);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photos', $filename);
            $photoUrl = Storage::url('photos/' . $filename);
        } else {
            $photoUrl = $product->photo_url;
        }

        // Update product
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'photo_url' => $photoUrl
        ]);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->photo_url) {
            $photoPath = str_replace('/storage/', 'public/', $product->photo_url);
            if (Storage::exists($photoPath)) {
                Storage::delete($photoPath);
            }
        }
        $product->delete();
        return redirect()->route('products.index');
    }

}