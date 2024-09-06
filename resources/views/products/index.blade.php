@extends('master')

@section('title', 'Product List')

@section('content')
<div class="container mt-4"> <!-- Reduced margin-top -->
    <div class="row mb-4">
        <!-- Sidebar with filters -->
        <div class="col-md-3">
            <div class="sidebar-card shadow-sm"> <!-- Sticky sidebar -->
                <div class="card-header bg-primary text-white">
                    <h5>Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="price_min">Min Price</label>
                            <input type="number" class="form-control" id="price_min" name="price_min" value="{{ request('price_min') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="price_max">Max Price</label>
                            <input type="number" class="form-control" id="price_max" name="price_max" value="{{ request('price_max') }}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </form>
                    <!-- Additional menus -->
                    <hr>
                    <h6>Categories</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Electronics</a></li>
                        <li><a href="#" class="text-decoration-none">Clothing</a></li>
                        <li><a href="#" class="text-decoration-none">Home & Kitchen</a></li>
                        <li><a href="#" class="text-decoration-none">Books</a></li>
                    </ul>
                    <hr>
                    <h6>Brands</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Brand A</a></li>
                        <li><a href="#" class="text-decoration-none">Brand B</a></li>
                        <li><a href="#" class="text-decoration-none">Brand C</a></li>
                    </ul>
                    <hr>
                    <h6>Rating</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">5 Stars</a></li>
                        <li><a href="#" class="text-decoration-none">4 Stars & Up</a></li>
                        <li><a href="#" class="text-decoration-none">3 Stars & Up</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-4 product-card position-relative">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                            <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            </div>
                        </a>
                        <!-- Cart Icon -->
                        <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="cart-icon-container position-absolute end-0 top-0 p-2">
                            <button class="btn btn-light border-0">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                        </form>        
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Styles for sidebar and product list -->
<style>
   /* Styles for sidebar and product list */
.container {
    margin-top: 0px; /* Adjust to reduce large spacing */
}

/* Product card hover effect */
.product-card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative; /* Make sure card is relative to contain the icon */
    transition: transform 0.3s ease-in-out;
}

.product-card:hover {
    transform: scale(1.05);
}

/* Cart icon container styles */
.cart-icon-container {
    opacity: 0; /* Hide the icon by default */
    transition: opacity 0.3s ease;
    position: absolute; /* Ensure the icon is positioned absolutely within the card */
    top: 10px; /* Distance from the top edge of the card */
    right: 10px; /* Distance from the right edge of the card */
}

/* Show the cart icon on hover */
.product-card:hover .cart-icon-container {
    opacity: 1; /* Show the icon on hover */
}

.cart-icon-container button {
    background: none; /* Remove background */
    border: none; /* Remove border */
    padding: 0; /* Remove padding */
    text-decoration: none;
}

.cart-icon-container i {
    font-size: 24px;
    color: #000000;
    transition: color 0.3s ease;
}

/* Change icon color on hover */
.product-card:hover .cart-icon-container i {
    color: #228be6; /* Change color on hover */
}

.product-img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

/* Sticky sidebar-specific styles */
.sidebar-card {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: -webkit-sticky;
    position: sticky;
    top: 20px; /* Adjust the top space to fit with the navbar */
}

.list-unstyled li {
    margin-bottom: 10px;
}

.list-unstyled li a:hover {
    color: black;
    text-decoration: underline;
}

/* Remove default focus and active styles for the cart icon button */
.cart-icon-container button:focus,
.cart-icon-container button:active {
    outline: none; /* Remove outline */
    box-shadow: none; /* Remove box shadow */
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
