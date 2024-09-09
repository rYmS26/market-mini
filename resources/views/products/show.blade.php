@extends('master')

@section('title', 'Product Details')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Left Column: Product Image -->
        <div class="col-md-6">
            <div class="product-image1">
                <img src="{{ $product->photo_url }}" class="img-fluid rounded-lg shadow-sm" alt="{{ $product->name }}">
            </div>
        </div>

        <!-- Right Column: Product Details -->
        <div class="col-md-6">
            <h1 class="display-4 mb-3">{{ $product->name }}</h1>
            <p class="lead mb-4">{{ $product->description }}</p>
            <p class="h3 mb-4"><strong>${{ $product->price }}</strong></p>

            <!-- Quantity and Buttons -->
            <div class="mt-4">
                <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="input-group me-3" style="max-width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decrementBtn">-</button>
                        <input type="number" class="form-control" name="quantity" min="1" value="1" id="quantityInput">
                        <button class="btn btn-outline-secondary" type="button" id="incrementBtn">+</button>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex align-items-center" title="Add to Cart">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </form>                
            </div>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mb-2">Back to List</a>
                <a href="{{ route('buy.product', $product->id) }}" class="btn btn-primary mb-2">Buy Now</a>
                <!-- Show Edit and Delete buttons if user is authenticated -->
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="col-md-3 mb-4">
                    <div class="card product-card border-0 rounded-lg shadow-sm">
                        <a href="{{ route('products.show', $relatedProduct->id) }}" class="text-decoration-none text-dark">
                            <img src="{{ $relatedProduct->photo_url }}" class="card-img-top rounded-top" alt="{{ $relatedProduct->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                <p class="card-text">{{ $relatedProduct->description }}</p>
                                <p class="card-text"><strong>${{ $relatedProduct->price }}</strong></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .product-image img {
        transition: transform 0.3s ease-in-out;
    }

    .product-image img:hover {
        transform: scale(1.05);
    }

    .product-card {
        transition: transform 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.03);
    }

    .cart-icon {
        border-radius: 50px;
        transition: background-color 0.3s ease;
    }

    .cart-icon:hover {
        background-color: #f8f9fa;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantityInput');
        const decrementBtn = document.getElementById('decrementBtn');
        const incrementBtn = document.getElementById('incrementBtn');

        decrementBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        incrementBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
</script>
@endsection
