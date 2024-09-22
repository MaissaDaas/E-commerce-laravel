<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $stripeKey = Config::get('services.stripe.key');
        return view('payment.form', compact('stripeKey'));
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 1000, // Montant en centimes (10.00 USD)
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            return response()->json(['paymentIntent' => $paymentIntent]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showPaymentSuccess(Request $request)
    {
        // return view('payment.success');
        $orderId = $request->query('order_id');
        $order = Order::find($orderId);
    
        if ($order) {
            $order->payment_status = 'Paid';
            $order->save();
    
            return redirect()->route('payment.success')->with('success', 'Paiement réussi et commande validée');
        }
    
        // return redirect()->route('payment.error')->withErrors(['error' => 'Erreur lors de la validation du paiement']);
    }

    public function showPaymentError()
    {
        return view('payment.error');
    }
}
