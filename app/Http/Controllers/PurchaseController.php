<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PurchaseController extends Controller
{
    // Display product details for purchase
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('transaction', compact('product'));
    }

    // Process payment based on the selected payment method
    public function processPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        if ($request->input('payment_method') === 'stripe') {
            // Stripe payment handling
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => $product->price * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->input('stripePaymentMethodId'),
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => $product->name,
            ]);

            // Handle the response from Stripe
            if ($paymentIntent->status === 'succeeded') {
                return redirect()->route('payment.success');
            } else {
                return redirect()->route('payment.failed')->withErrors('Payment failed: ' . $paymentIntent->last_payment_error->message);
            }
        }

        // Handle other payment methods if needed
        return redirect()->route('payment.failed')->withErrors('Unsupported payment method.');
    }

    // Show payment success page
    public function paymentSuccess()
    {
        return view('payment_success');
    }

    // Show payment failure page
    public function paymentFailed()
    {
        return view('payment_failed');
    }
}
