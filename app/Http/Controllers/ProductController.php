<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Index method for admin product management
    public function adminIndex(Request $request)
    {

        $query = Product::query();       // Apply filtering
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // Use paginate() instead of get()
        $products = $query->paginate(5); // 12 products per page

        return view('admin.products.index', compact('products'));
    }

    public function adminCreate()
    {
        return view('admin.products.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        $photoUrl = null; // Initialize photoUrl
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

        return redirect()->route('products.index');
    }

    public function adminShow($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function adminEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function adminUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Find the product by its ID
        $product = Product::findOrFail($id);
    
        // Handle file upload if a new photo is provided
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($product->photo_url) {
                $photoPath = str_replace('/storage/', 'public/', $product->photo_url);
                if (Storage::exists($photoPath)) {
                    Storage::delete($photoPath);
                }
            }
    
            // Store the new photo
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photos', $filename);
            $validatedData['photo_url'] = Storage::url('photos/' . $filename);
        } else {
            // Preserve the existing photo URL if no new photo is uploaded
            $validatedData['photo_url'] = $product->photo_url;
        }
    
        // Update the product with the validated data
        $product->update($validatedData);
    
        // Redirect back to a specific route with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    

    public function adminDestroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->photo_url) {
            $photoPath = str_replace('/storage/', 'public/', $product->photo_url);
            if (Storage::exists($photoPath)) {
                Storage::delete($photoPath);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
