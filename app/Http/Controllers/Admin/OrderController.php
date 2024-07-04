<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\User;
use App\Models\OrderItem; 
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function showorder()
    {
        // $orders = Order::with('user')->get();
        // $orders = Order::with(['orderItems.product'])->get();
        $orders = Order::with(['user', 'orderItems.product'])->get();

        // $orders->load('orderitems');
        // $orderItem = OrderItem::all();
        $user = User::all();
        return view('dashbord.order', compact('orders', 'user'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        // return view('categories.edit', compact('order'));
    }

    public function update(OrderRequest $request, $id)
    {
        $validated = $request->validated();

        $order = Order::findOrFail($id);
  
        $order->status = $validated['status'];
        $order->payment_status = $validated['payment_status'];

        $order->save();

        return redirect()->route('orderAdmin')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orderAdmin');
    }
}
