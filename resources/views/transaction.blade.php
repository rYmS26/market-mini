<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Purchase Product</h1>
    <h2>{{ $product->name }}</h2>
    <p>Price: ${{ $product->price }}</p>

    <form id="payment-form" action="{{ route('process.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" id="stripePaymentMethodId" name="stripePaymentMethodId">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <div id="card-errors" role="alert"></div>

        <button type="submit" class="btn btn-primary btn-block mt-3">Pay Now</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
            },
        }).then(function(result) {
            if (result.error) {
                // Display error in payment form
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the PaymentMethod ID to your server
                document.getElementById('stripePaymentMethodId').value = result.paymentMethod.id;
                form.submit();
            }
        });
    });
</script>

</body>
</html>
