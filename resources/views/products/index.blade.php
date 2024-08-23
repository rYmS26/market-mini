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
                        <div class="position-absolute top-0 end-0 p-3">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-primary" title="Add to Cart">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M5.5 0a.5.5 0 0 1 .5.5V1h4V.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5V1h1a.5.5 0 0 1 .485.379l1 5A.5.5 0 0 1 16 6H2.665l-.62-3.095a.5.5 0 0 1-.074-.293L.507 1.325A.5.5 0 0 1 1 1h1a.5.5 0 0 1 .485.379l.38 1.903H5.5a.5.5 0 0 1 .485.379l1 5A.5.5 0 0 1 7 8H16a.5.5 0 0 1 .485.379l1 5a.5.5 0 0 1-.485.621H5.5a.5.5 0 0 1-.485-.379L5.5 0zm6 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm-4 1a1 1 0 1 0 2 0 1 1 0 0 0-2 0zM11.5 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm4 1a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                                    </svg>
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
@endsection
