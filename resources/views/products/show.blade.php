@extends('master')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <img src="{{ $product->photo_url }}" class="img-fluid" alt="{{ $product->name }}">
    <p>{{ $product->description }}</p>
    <p><strong>${{ $product->price }}</strong></p>

    <!-- Back to List Button -->
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>

    <!-- Buy Button -->
    <a href="{{ route('buy.product', $product->id) }}" class="btn btn-primary">Buy Now</a>
</div>
@endsection
