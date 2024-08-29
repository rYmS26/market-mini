<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

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
        $product = Product::findOrFail($request->input('product_id'));
        
        if ($request->input('payment_method') === 'stripe') {
            // Stripe payment handling
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $charge = Charge::create([
                'amount' => $product->price * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->input('stripeToken'),
                'description' => $product->name,
            ]);

            return redirect()->route('payment.success');
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
