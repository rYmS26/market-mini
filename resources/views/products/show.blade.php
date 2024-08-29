@extends('master')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Column: Product Image -->
        <div class="col-md-6">
            <img src="{{ $product->photo_url }}" class="img-fluid" alt="{{ $product->name }}">
        </div>

        <!-- Right Column: Product Details -->
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p><strong>${{ $product->price }}</strong></p>

            <!-- Buttons -->
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary mb-2">Back to List</a>
                <a href="{{ route('buy.product', $product->id) }}" class="btn btn-primary mb-2">Buy Now</a>
                <a href="{{ route('products.show', $product->id) }}" class="btn mb-2" style="background-color: #179BAE; color: white;">View</a>

                <!-- Show Edit and Delete buttons if user is authenticated -->
                @if(Auth::check())
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mb-2">Edit</a>
                    
                    <!-- Ensure Delete button displays properly -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mb-2">Delete</button>
                    </form>
                @endif
            </div>

            <!-- Add to Cart -->
            <div class="cart-icon-container mt-4">
                <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button type="submit" class="cart-icon btn btn-outline-secondary" title="Add to Cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
