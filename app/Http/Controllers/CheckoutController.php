<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($carts->count() == 0) {
            return redirect()->route('shop');
        }
        
        $subtotal = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout', compact('carts', 'subtotal'));
    }

    // Proses Pembayaran (Trigger dari PayPal JS)
    public function process(Request $request)
    {
        // Validasi data dari AJAX
        $data = $request->validate([
            'payment_id' => 'required', // PayPal Order ID
            'total' => 'required|numeric'
        ]);

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();

        // Buat Order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount' => $data['total'],
            'status' => 'paid', // Anggap langsung paid untuk demo sandbox
            'payment_method' => 'PayPal',
            'transaction_id' => $data['payment_id']
        ]);

        // Kosongkan Cart
        Cart::where('user_id', $user->id)->delete();

        return response()->json(['success' => true, 'redirect_url' => route('order.success')]);
    }

    public function success()
    {
        return view('order_success');
    }
}