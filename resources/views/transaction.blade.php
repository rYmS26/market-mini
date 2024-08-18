@extends('master')

@section('title', 'Transaction')

@section('content')
<div class="container">
    <h1>Purchase Product</h1>
    <h2>{{ $product->name }}</h2>
    <p>Price: ${{ $product->price }}</p>

    <form action="{{ route('process.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select class="form-control" id="payment_method" name="payment_method">
                <option value="stripe">Stripe</option>
            </select>
        </div>
        <div id="stripe-form" style="display:none;">
            <!-- Stripe Payment Form -->
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ config('services.stripe.key') }}"
                    data-description="Purchase Product"
                    data-amount="{{ $product->price * 100 }}"
                    data-locale="auto"></script>
        </div>
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>

@section('scripts')
<script>
    document.getElementById('payment_method').addEventListener('change', function () {
        var value = this.value;
        if (value === 'stripe') {
            document.getElementById('stripe-form').style.display = 'block';
        } else {
            document.getElementById('stripe-form').style.display = 'none';
        }
    });
</script>
@endsection
@endsection
