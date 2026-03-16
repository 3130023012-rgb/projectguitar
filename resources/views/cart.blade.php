@extends('layouts.app')

@section('logo-text', "LYNN'S BASS & GUITAR")

@section('styles')
<style>
    .cart-section { padding: 120px 50px; min-height: 100vh; background: #050505; }
    .cart-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
    .cart-table th { text-align: left; color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 20px; border-bottom: 1px solid #333; }
    .cart-table td { padding: 30px 0; border-bottom: 1px solid #1a1a1a; vertical-align: top; }
    
    .cart-product { display: flex; gap: 20px; }
    .cart-product img { width: 120px; height: 120px; object-fit: cover; background: #111; }
    .cart-product-info h3 { font-size: 1.2rem; font-weight: 500; margin-bottom: 10px; color: #fff; }
    .cart-product-info p { color: #666; font-size: 0.9rem; margin-bottom: 5px; }
    
    .cart-price { color: var(--gold); font-size: 1.1rem; font-family: 'Playfair Display', serif; }
    
    .cart-summary { background: #0f0f0f; padding: 40px; float: right; width: 400px; border: 1px solid #222; }
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; color: #888; }
    .summary-total { border-top: 1px solid #333; padding-top: 20px; margin-top: 20px; display: flex; justify-content: space-between; font-size: 1.5rem; color: #fff; font-weight: 600; }
    
    .btn-checkout { width: 100%; padding: 18px; background: var(--gold); color: #000; border: none; text-transform: uppercase; font-weight: 700; cursor: pointer; font-size: 0.9rem; margin-top: 20px; transition: 0.3s; }
    .btn-checkout:hover { background: #fff; }
    
    .btn-remove { background: none; border: none; color: #555; cursor: pointer; font-size: 0.8rem; text-decoration: underline; }
    .btn-remove:hover { color: #ff4d4d; }
</style>
@endsection

@section('content')
<div class="cart-section">
    <h2 style="margin-bottom: 40px; font-weight: 300;">Shopping Cart ({{ $carts->count() }} items)</h2>

    @if($carts->count() > 0)
    <div style="display: flex; gap: 50px;">
        <!-- List Cart -->
        <div style="flex: 1;">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $item)
                    <tr>
                        <td>
                            <div class="cart-product">
                                <img src="{{ asset($item->product->image) }}" alt="">
                                <div class="cart-product-info">
                                    <h3>{{ $item->product->name }}</h3>
                                    <p>{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="cart-price">${{ number_format($item->product->price, 2) }}</td>
                        <td style="color: #fff;">{{ $item->quantity }}</td>
                        <td class="cart-price">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf @method('POST')
                                <button type="submit" class="btn-remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div>
            <div class="cart-summary">
                <h3 style="margin-bottom: 20px; text-transform: uppercase;">Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span style="color: var(--gold);">FREE</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span style="color: var(--gold);">${{ number_format($subtotal, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn-checkout" style="text-align:center; display:block; text-decoration:none;">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
    @else
        <div style="text-align: center; margin-top: 100px;">
            <h3 style="font-weight: 300; color: #888;">Your cart is empty.</h3>
            <a href="{{ route('shop') }}" style="color: var(--gold); text-decoration: underline; margin-top: 20px; display: inline-block;">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection