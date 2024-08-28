@extends('master')

@section('title', 'Product Details')

@section('content')
<div class="container">
    <div class="row">
        <!-- Product Image on the Left -->
        <div class="col-md-6">
            <img src="{{ $product->photo_url }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        
        <!-- Product Details on the Right -->
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p><strong>${{ $product->price }}</strong></p>

            <!-- Buttons -->
            <div class="mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('buy.product', $product->id) }}" class="btn btn-primary">Buy Now</a>
                
                <!-- Only show Edit and Delete buttons if the user is authenticated -->
                @if(Auth::check())
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
