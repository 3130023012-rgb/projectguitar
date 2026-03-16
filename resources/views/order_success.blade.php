@extends('layouts.app')

@section('logo-text', "ORDER SUCCESS")

@section('content')
<div style="padding: 150px 50px; text-align: center; background: #050505; min-height: 100vh;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="font-size: 5rem; color: var(--gold); margin-bottom: 30px;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 style="font-size: 2.5rem; font-weight: 300; margin-bottom: 20px;">Thank You For Your Purchase!</h1>
        <p style="color: #888; font-size: 1.1rem; margin-bottom: 40px;">
            Your order has been placed successfully. We will start processing your guitar immediately. 
            You will receive a shipping confirmation email shortly.
        </p>
        
        <div style="background: #111; padding: 20px; border: 1px solid #222; margin-bottom: 40px; display: inline-block;">
            <h4 style="color: #888; font-size: 0.8rem; text-transform: uppercase;">Order Status</h4>
            <h3 style="color: var(--gold); font-size: 1.5rem;">Payment Received - Processing</h3>
        </div>

        <div>
            <a href="{{ route('shop') }}" class="btn btn-primary" style="text-decoration:none; padding: 15px 30px; border: 1px solid #fff; color: #fff; background: transparent; font-weight: 600; text-transform: uppercase;">
                Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection