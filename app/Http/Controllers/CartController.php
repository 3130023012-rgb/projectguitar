<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        $userId = auth()->id();
        $productId = $request->product_id;

        // Cek jika produk sudah ada di cart
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }

    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $subtotal = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('carts', 'subtotal'));
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())->where('id', $id)->delete();
        return back()->with('success', 'Item removed.');
    }
}