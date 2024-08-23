@extends('master')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between jumbotron" style="min-height: 400px;">
        <div class="left-content">
            <h1>Welcome to My Website</h1>
            <p>This is the landing page of the website. Explore and enjoy our services.</p>
            @if(Auth::check())
                <p>You are logged in as <b>{{ Auth::user()->name }}</b> with the role of <b>{{ Auth::user()->role }}</b>.</p>
            @else
                <p><a class="btn btn-lg" href="{{ route('login') }}" role="button" style="background-color: #179BAE; color: white;">Login</a></p>
            @endif
        </div>
        <div class="right-content">
        <img src="{{ asset('storage/photos/somat.png') }}" alt="Placeholder Image" class="img-fluid">
        </div>
    </div>

    <!-- Section for Product, Features, and Pricing -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 50vh; padding-top: 20px; padding-bottom: 20px;">
        <div class="text-center">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
        </div>
    </div>

    <!-- Section to include the top 3 product cards -->
    <div class="container">
    <h2 class="text-center mb-4">Top 3 Products</h2>
    <div class="row">
        @foreach($topProducts as $product)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><strong>${{ $product->price }}</strong></p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn" style="background-color: #179BAE; color: white;">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Center the "tes" button -->
    <div class="d-flex justify-content-center">
    <button class="btn mb-4" style="background-color: #179BAE;">
        <a href="{{ route('products.index') }}" style="color: white; text-decoration: none;">View More</a>
    </button>
</div>

</div>
@endsection
