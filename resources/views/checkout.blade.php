@extends('layouts.app')

@section('logo-text', "CHECKOUT")

@section('styles')
<style>
    .checkout-layout { display: grid; grid-template-columns: 1.5fr 1fr; gap: 50px; padding: 120px 50px; background: #050505; min-height: 100vh; }
    .checkout-card { background: #0f0f0f; padding: 40px; border: 1px solid #222; }
    .checkout-title { font-size: 1.2rem; margin-bottom: 30px; border-bottom: 1px solid #333; padding-bottom: 15px; }
    
    .item-mini { display: flex; gap: 15px; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #222; }
    .item-mini img { width: 60px; height: 60px; object-fit: cover; }
    .item-info { display: flex; flex-direction: column; justify-content: center; }
    .item-name { font-size: 0.9rem; color: #fff; }
    .item-price { font-size: 0.8rem; color: var(--gold); }
    
    .summary-final { margin-top: 30px; padding-top: 20px; border-top: 1px solid #333; font-size: 1.5rem; color: #fff; display: flex; justify-content: space-between; }
    
    /* PayPal Button Container */
    #paypal-button-container { margin-top: 30px; }
    
    .alert-warning { background: rgba(202, 169, 108, 0.1); border: 1px solid var(--gold); padding: 15px; color: var(--gold); margin-bottom: 20px; font-size: 0.9rem; }
</style>
@endsection

@section('content')
<div class="checkout-layout">
    <!-- Kiri: Ringkasan Item -->
    <div>
        <div class="checkout-card">
            <h2 class="checkout-title">Your Order ({{ $carts->count() }} items)</h2>
            
            @foreach($carts as $item)
            <div class="item-mini">
                <img src="{{ asset($item->product->image) }}" alt="">
                <div class="item-info">
                    <span class="item-name">{{ $item->product->name }}</span>
                    <span class="item-price">Qty: {{ $item->quantity }} x ${{ number_format($item->product->price, 2) }}</span>
                </div>
                <div style="margin-left:auto; color:#fff;">${{ number_format($item->product->price * $item->quantity, 2) }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Kanan: Pembayaran -->
    <div>
        <div class="checkout-card">
            <h2 class="checkout-title">Payment Method</h2>
            
            <div class="alert-warning">
                <i class="fas fa-info-circle"></i> This is a demo checkout using PayPal Sandbox. No real charges will be made.
            </div>

            <div class="summary-final">
                <span>Total:</span>
                <span style="color:var(--gold);">${{ number_format($subtotal, 2) }}</span>
            </div>

            <!-- PayPal Buttons Script -->
            <div id="paypal-button-container"></div>
            
            <div id="processing-payment" style="display:none; text-align:center; margin-top:20px; color:#fff;">
                <p>Processing your payment... Please wait.</p>
            </div>

        </div>
    </div>
</div>

<!-- PayPal JS SDK -->
<!-- Ganti 'test' dengan Client ID Sandbox Anda jika sudah punya, jika tidak biarkan 'test' atau dummy ID -->
<script src="https://www.paypal.com/sdk/js?client_id=test&currency=USD"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ number_format($subtotal, 2, '.', '') }}' // Ambil dari Laravel
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Capture the funds from the transaction
            document.getElementById('paypal-button-container').style.display = 'none';
            document.getElementById('processing-payment').style.display = 'block';

            return actions.order.capture().then(function(details) {
                // Show a success message to your buyer
                // Kirim data ke backend untuk simpan database
                fetch("{{ route('checkout.process') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        payment_id: data.orderID,
                        total: '{{ number_format($subtotal, 2, '.', '') }}'
                    })
                })
                .then(res => res.json())
                .then(response => {
                    if(response.success) {
                        window.location.href = response.redirect_url;
                    } else {
                        alert('Error saving order.');
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection