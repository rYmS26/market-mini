@extends('master')

@section('title', 'Cart')

@section('content')
<div class="cart_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">
                        Shopping Cart <small> ({{ count($cartItems) > 0 ? count($cartItems) : '0' }} items in your cart) </small>
                    </div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @forelse ($cartItems as $id => $quantity)
                                @php    
                                    $product = $products->get($id);
                                    $totalPrice = $product ? $product->price * $quantity : 0;
                                @endphp
                                @if ($product)
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image">
                                            <img src="{{ $product->photo_url }}" alt="{{ $product->name }}">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $product->name }}</div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">${{ number_format($product->price, 2) }}</div>
                                            </div>
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <input type="number" class="cart_item_quantity_input" data-id="{{ $id }}" value="{{ $quantity }}" min="1">
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text" data-id="{{ $id }}">$ {{ number_format($totalPrice, 2) }}</div>
                                            </div>
                                            <div class="cart_item_remove cart_info_col">
                                                <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="button cart_button_remove">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @empty
                                <li class="cart_item clearfix">
                                    <div class="cart_item_info">Your cart is empty.</div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    @if (count($cartItems) > 0)
                        @php
                            // Convert $cartItems = sessionarray to a Collection for reduction
                            $cartItemsCollection = collect($cartItems);

                            // Calculate total amount for all items in the cart
                            $totalAmount = $cartItemsCollection->reduce(function ($carry, $quantity, $id) use ($products) {
                                $product = $products->get($id);
                                return $carry + ($product ? $product->price * $quantity : 0);
                            }, 0);
                        @endphp
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">${{ number_format($totalAmount, 2) }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- Payment Form -->
                    <form action="{{ route('process.payment') }}" method="POST">
                        @csrf
                        <!-- Hidden inputs for all cart items -->
                        @foreach ($cartItems as $id => $quantity)
                            @php
                                $product = $products->get($id);
                            @endphp
                            @if ($product)
                                <input type="hidden" name="products[{{ $id }}][id]" value="{{ $product->id }}">
                                <input type="hidden" name="products[{{ $id }}][quantity]" value="{{ $quantity }}">
                            @endif
                        @endforeach

                        <div class="cart_buttons">
                            <a href="{{ route('products.index') }}" class="button cart_button_clear">Continue Shopping</a>
                            @if (count($cartItems) > 0)
                                <button type="submit" class="button cart_button_checkout" style="background-color: #228be6;">Checkout</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Assuming you have a stylesheet or inline <style> block */
    .button.cart_button_remove {
        background-color: #228be6;
        color: #ffffff;
        border: 2px solid transparent; /* Initial border color */
        transition: all 0.3s ease; /* Smooth transition */
    }

    .button.cart_button_remove:hover {
        background-color: #ffffff; /* Background color on hover */
        color: #228be6; /* Text color on hover */
        border: 2px solid #228be6; /* Border color on hover */
    }

</style>

<script>
    document.querySelectorAll('.cart_item_quantity_input').forEach(function(input) {
        input.addEventListener('change', function() {
            let id = this.getAttribute('data-id');
            let quantity = this.value;

            fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let priceElement = this.closest('.cart_item_info').querySelector('.cart_item_price .cart_item_text');
                    let price = parseFloat(priceElement.textContent.replace('$', '').replace(',', ''));
                    let totalElement = this.closest('.cart_item_info').querySelector('.cart_item_total .cart_item_text');
                    totalElement.textContent = '$' + (price * quantity).toFixed(2);

                // Optionally update the order total here
                let orderTotal = 0;
                document.querySelectorAll('.cart_item_total .cart_item_text').forEach(function(total) {
                    orderTotal += parseFloat(total.textContent.replace('$', '').replace(',', ''));
                });
                document.querySelector('.order_total_amount').textContent = '$' + orderTotal.toFixed(2);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

<style>
    *{margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-webkit-text-shadow: rgba(0,0,0,.01) 0 0 1px;text-shadow: rgba(0,0,0,.01) 0 0 1px}
    body{font-family: 'Rubik', sans-serif;font-size: 14px;font-weight: 400;background: #E0E0E0;color: #000000}
    ul{list-style: none;margin-bottom: 0px}
    .button{display: inline-block;background: #0e8ce4;border-radius: 5px;height: 48px;-webkit-transition: all 200ms ease;-moz-transition: all 200ms ease;-ms-transition: all 200ms ease;-o-transition: all 200ms ease;transition: all 200ms ease}
    .button a{display: block;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px}
    .button:hover{opacity: 0.8}
    .cart_section{width: 100%;padding-top: 93px;padding-bottom: 111px}
    .cart_title{font-size: 30px;font-weight: 500}
    .cart_items{margin-top: 8px}
    .cart_list{border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);background-color: #fff}
    .cart_item{width: 100%;padding: 15px;padding-right: 46px}
    .cart_item_image{width: 133px;height: 133px;float: left}
    .cart_item_image img{max-width: 100%}
    .cart_item_info{width: calc(100% - 133px);float: left;padding-top: 18px}
    .cart_item_name{margin-left: 7.53%}
    .cart_item_title{font-size: 14px;font-weight: 400;color: rgba(0,0,0,0.5)}
    .cart_item_text{font-size: 18px;margin-top: 35px}
    .cart_item_text span{display: inline-block;width: 20px;height: 20px;border-radius: 50%;margin-right: 11px;-webkit-transform: translateY(4px);-moz-transform: translateY(4px);-ms-transform: translateY(4px);-o-transform: translateY(4px);transform: translateY(4px)}
    .cart_item_price{text-align: right}
    .cart_item_total{text-align: right}
    .order_total{width: 100%;height: 60px;margin-top: 30px;border: solid 1px #e8e8e8;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);padding-right: 46px;padding-left: 15px;background-color: #fff}
    .order_total_title{display: inline-block;font-size: 14px;color: rgba(0,0,0,0.5);line-height: 60px}
    .order_total_amount{display: inline-block;font-size: 18px;font-weight: 500;margin-left: 26px;line-height: 60px}
    .cart_buttons{margin-top: 60px;text-align: right}
    .cart_button_clear{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: rgba(0,0,0,0.5);background: #FFFFFF;border: solid 1px #b2b2b2;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;margin-right: 26px}
    .cart_button_clear:hover{border-color: #0e8ce4;color: #0e8ce4}
    .cart_button_checkout{display: inline-block;border: none;font-size: 18px;font-weight: 400;line-height: 48px;color: #FFFFFF;padding-left: 35px;padding-right: 35px;outline: none;cursor: pointer;vertical-align: top}
</style>
@endsection
