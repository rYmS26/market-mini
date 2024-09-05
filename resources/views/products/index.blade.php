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
            <div class="row">
    @foreach ($products as $product)
        <div class="col-md-3">
            <div class="card mb-4 position-relative">
                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                    <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>${{ $product->price }}</strong></p>
                    </div>
                </a>
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

            <!-- Pagination links -->
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .product-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .cart-icon-container {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 100;
    }

    .cart-icon-container button {
        background: none;
        border: none;
        color: #007bff;
        font-size: 1.5rem;
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
        transform: scale(0.95);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
