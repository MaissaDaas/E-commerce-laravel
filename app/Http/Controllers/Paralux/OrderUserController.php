<?php

namespace App\Http\Controllers\paralux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panier; 
use App\Models\Product; 
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem; 
use Illuminate\Support\Facades\Log;
use App\Http\Requests\OrderUserRequest;
use App\Http\Requests\AddresseRequest;
use App\Http\Requests\PaimentMethodeRequest;

class OrderUserController extends Controller
{
    public function showorderuser()
    {
        $user = auth()->user();
        $paniers = $user->panier()->with('product')->get();
        $products = Product::all();

        $subtotal = $paniers->sum(function ($panier) {
            return $panier->quantity * $panier->product->price;
        });

        $deliveryFee = 7.000;
        $total = $subtotal + $deliveryFee;

        foreach ($paniers as $panier) {
            $panier->total_amount = $panier->quantity * $panier->product->price;
        }

        $address = $user->address;
        $order = new Order(); 

        return view('paralux.orderUser', compact('paniers', 'products', 'subtotal', 'total' , 'deliveryFee', 'address','order'));
    }

    public function createorderuser(OrderUserRequest $request)
    {   
        // dd($request);
        // Log::info('addAddresse called', ['request' => $request->all()]);
        $validated = $request->validated();

        $userId = auth()->id();
        $order = Order::create([
            'user_id' => $userId,
            'grand_total' => $validated['grand_total'],
            'payment_method' => $validated['payment_method'],
            'payment_status' => $validated['payment_status'] ?? 'Pending',
            'status' => $validated['status'] ?? 'New',
            'currency' => $validated['currency'] ?? 'TND',
            'shipping_amount' => $validated['shipping_amount'] ?? '7.00',
            'shipping_method' => $validated['shipping_method'] ?? 'First delivery',
            'notes' => $validated['notes'] ?? null,
        ]);

        $paniers = Panier::where('user_id', $userId)->get();

        foreach ($paniers as $panier) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $panier->product_id,
                'quantity' => $panier->quantity,
            ]);
        }

        Panier::where('user_id', $userId)->delete();

        $paymentMethod = $validated['payment_method']; 

        if ($paymentMethod === 'Paiement en ligne') {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data'=>[
                            'name'=>'Order ' .$order->id,
                        ],
                        'unit_amount' => $order->grand_total * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode'=>'payment',
                "success_url" => route('payment.success', ['order_id' => $order->id]),
                "cancel_url" => route('payment.error', ['order_id' => $order->id])

                // "success_url" => route('payment.success'),
                // "cancel_url" => route('payment.success')
            ]);

            return redirect($session->url);

            // if ($session->status == 'succeeded') {
            //     return redirect()->route('payment.success');
            // } else {
            //     return redirect()->back()->withErrors(['payment.error' => 'Payment failed. Please try again.']);
            // }
        }

        return redirect()->route('showAllOrders')->with('success', 'la cmmande est bien valider');
    }

    public function addAddresse(Request $request)
    {   
        $orderId = Order::count();
        
        $userId = auth()->id();
        $address = Address::create([
            'user_id' => $userId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
        ]);
        return redirect()->route('showorderuser')->with('success', 'La commande est bien validée avec l\'adresse.');
    }


    public function saveAddress(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
        ]);

        if ($user->address) {
            $user->address->update($data);
            return redirect()->route('showorderuser')->with('success', 'Address updated successfully.');
        } else {
            $data['user_id'] = $user->id;
            Address::create($data);
            return redirect()->route('showorderuser')->with('success', 'Address created successfully.');
        }
    }

    public function updateMethodePaiment(PaimentMethodeRequest $request, $id)
    {
        $validated = $request->validated();

        $order = Order::findOrFail($id);
  
        $order->payment_method = $validated['payment_method'];

        $order->save();

        return redirect()->route('orderAdmin')->with('success', 'Payment Method updated successfully.');
    }

    public function showAllOrders() {
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)
            ->with(['user', 'orderItems.product'])
            ->get();
    
        return view('paralux.orderView', compact('orders'));
    }

}
