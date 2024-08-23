<!-- resources/views/cart/index.blade.php -->
@extends('master')

@section('title', 'Cart')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if($cartItems)
        <ul class="list-group">
            @foreach($cartItems as $id => $quantity)
                <li class="list-group-item">
                    Item ID: {{ $id }} - Quantity: {{ $quantity }}
                    <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
