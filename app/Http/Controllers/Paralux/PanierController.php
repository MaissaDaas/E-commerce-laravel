<?php

namespace App\Http\Controllers\paralux;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Panier; 
use App\Models\Order;
use App\Models\Product; 
use App\Http\Requests\PanierRequest;
use App\Http\Requests\UpdatePanierRequest;


class PanierController extends Controller
{
    public function showpanier(Request $request)
    {
        if (auth()->check()) {
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

            $orderCount = Order::where('user_id', $user->id)->count();

            return view('paralux.panier', compact('paniers', 'products', 'subtotal', 'total' , 'deliveryFee','orderCount'));
        }
        else {
            return redirect()->route('login_form')->with('error', 'Vous devez être connecté pour voir votre panier.');
            // $response->withCookie(cookie('product_id', 'test'));
            // $response->withCookie(cookie('key', $value));
            // $sessionCart = $request->cookie('product_id');
            // dd($sessionCart);
            // $products = Product::where('id', $sessionCart)->get();
            // $paniers = collect();
            // $subtotal = 0;

            // foreach ($products as $product) {
            //     $quantity = $sessionCart;
            //     $panier = (object) [
            //         'product' => $product,
            //         'quantity' => $quantity,
            //         'total_amount' => $quantity * $product->price,
            //     ];
            //     $paniers->push($panier);
            //     $subtotal += $panier->total_amount;
            // }

            // $deliveryFee = 7.000;
            // $total = $subtotal + $deliveryFee;

            // return view('paralux.panier', compact('paniers', 'subtotal', 'total', 'deliveryFee'));
        }
    }

    public function addpanier(PanierRequest $request)
    {
        // $request->session()->put('product_id', 'test');
    
        $validated = $request->validated();

        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You need to be logged in to add items to your cart.']);
        }  

        $userId = auth()->id();
        $panier = Panier::where('product_id', $validated['product_id'])
            ->where('user_id', $userId)
            ->first();
    
        if ($panier) {
            $panier->quantity += $validated['quantity'];
            $panier->save();
            \Log::info('Product quantity updated in cart', ['product_id' => $validated['product_id'], 'user_id' => $userId]);
        } else {
            Panier::create([
                'product_id' => $validated['product_id'],
                'user_id' => $userId,
                'quantity' => $validated['quantity'],
            ]);
            \Log::info('Product added to cart', ['product_id' => $validated['product_id'], 'user_id' => $userId]);
        }   
    }
    
    public function edit($id)
    {
        $panier = Panier::findOrFail($id);
        return view('panier.edit', compact('panier'));
    }

    public function update(UpdatePanierRequest $request, $id)
    {
        $validated = $request->validated();

        $panier = Panier::findOrFail($id);
        $panier->quantity = $validated['quantity'];
        // $panier->total_amount = $validated['quantity'] * $panier->unit_amount;

        $panier->update();

        return redirect()->route('showpanier')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $panier = Panier::findOrFail($id);
        $panier->delete();
        return redirect()->route('showpanier');
    }
}
