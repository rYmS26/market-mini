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
            <!-- Conditionally show Add Product and Report Buttons -->
            @if(Auth::check())
                <div class="mb-3">
                    <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
                    <a href="{{ route('product.report') }}" class="btn btn-danger">Generate Report</a>
                </div>
            @endif

            <!-- Product Cards -->
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
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
