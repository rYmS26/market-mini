<!-- resources/views/products/index.blade.php -->
@extends('master')

@section('title', 'Product List')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Filter</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="price_min">Min Price</label>
                            <input type="number" class="form-control" id="price_min" name="price_min" value="{{ request('price_min') }}">
                        </div>
                        <div class="form-group">
                            <label for="price_max">Max Price</label>
                            <input type="number" class="form-control" id="price_max" name="price_max" value="{{ request('price_max') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            @if(Auth::check())
                <div class="mb-3">
                    <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
                    <a href="{{ route('product.report') }}" class="btn btn-danger">Generate Report</a>
                </div>
            @endif

            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4">
                <div class="card mb-4 position-relative">
    <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>${{ $product->price }}</strong></p>
        <a href="{{ route('products.show', $product->id) }}" class="btn" style="background-color: #179BAE; color: white;">View</a>

        @if(Auth::check())
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    </div>
    <div class="cart-icon-container">
    <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
        @csrf
        <input type="hidden" name="id" value="{{ $product->id }}">
        <button type="submit" class="cart-icon" title="Add to Cart">
            <i class="fas fa-shopping-cart"></i>
        </button>
    </form>
</div>
         
</div>

</div>

                @endforeach
            </div>
        </div>
    </div>
</div>
<style>
   .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative; /* Ensure the card is positioned relatively */
    }

    .product-img {
        width: 100%;
        height: auto;
        object-fit: cover; /* Ensure the image covers the card area */
    }

    .cart-icon-container {
        position: absolute;
        top: 10px; /* Adjust as needed */
        right: 10px; /* Adjust as needed */
        z-index: 100; /* Ensure the cart icon is above other content */
    }

    .cart-icon-container button {
        background: none;
        border: none;
        color: #007bff; /* Adjust color as needed */
        font-size: 1.5rem; /* Adjust size as needed */
    }

    .cart-icon-container svg {
        width: 24px; /* Adjust size as needed */
        height: 24px; /* Adjust size as needed */
    }
    .cart-icon i {
        font-size: 24px;
        color: #000000;
        transition: color 0.3s ease;
    }

    .cart-icon:hover i {
        color: #179BAE;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(0.95); /* Shrink the card slightly on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    }

    .product-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@endsection
