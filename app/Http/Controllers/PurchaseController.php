<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Midtrans;
use Midtrans\Snap;
use Stripe\Charge;
use Stripe\Stripe;

class PurchaseController extends Controller
{
    public function buy($id)
    {
        $product = Product::find($id);
        return view('transaction', compact('product'));
    }

    public function processPayment(Request $request)
    {
        $product = Product::find($request->input('product_id'));
        
        if ($request->input('payment_method') === 'midtrans') {
            // Midtrans payment handling
            Midtrans::setApiKey(env('MIDTRANS_SERVER_KEY'));
            $snapToken = Snap::createTransaction([
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $product->price,
                ],
                'customer_details' => [
                    'first_name' => $request->input('name'),
                    'email' => $request->input('email'),
                ],
            ])->token;
            
            return redirect()->route('midtrans.checkout', ['snap_token' => $snapToken]);

        } elseif ($request->input('payment_method') === 'stripe') {
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
    }

    public function paymentSuccess()
    {
        return view('payment_success');
    }
}
