@extends('layouts.app')

@section('logo-text', "LYNN'S BASS & GUITAR")

@section('styles')
<style>
    /* CSS Khusus Contact */
    .contact-grid { display: grid; grid-template-columns: 1fr 1.5fr; min-height: 100vh; margin-top: 80px; }
    .contact-info { background-color: #0b0b0b; padding: 80px 50px; display: flex; flex-direction: column; justify-content: center; }
    .info-item { margin-bottom: 40px; }
    .info-label { font-size: 0.8rem; color: var(--grey); text-transform: uppercase; margin-bottom: 10px; }
    .info-value { font-size: 1.2rem; color: var(--white); display: flex; align-items: center; gap: 15px; }
    .info-icon { width: 40px; height: 40px; border: 1px solid var(--grey); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
    
    .contact-form-container { background-color: var(--black-bg); padding: 80px; display: flex; flex-direction: column; justify-content: center; }
    .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
    .form-group { width: 100%; margin-bottom: 20px; }
    .form-control { width: 100%; background: transparent; border: 1px solid var(--dark-grey); padding: 15px; color: var(--white); font-family: 'Montserrat', sans-serif; font-size: 1rem; }
    .form-control:focus { outline: none; border-color: var(--white); }
    @media (max-width: 768px) { .contact-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<div class="contact-grid">
    <!-- Left: Info -->
    <div class="contact-info">
        <div class="info-item">
            <div class="info-label">Email</div>
            <div class="info-value">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                hello@lynnsbass.com
            </div>
        </div>
        <div class="info-item">
            <div class="info-label">Workshop</div>
            <div class="info-value">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                Bali, Indonesia
            </div>
        </div>
        <div class="info-item">
            <div class="info-label">WhatsApp</div>
            <div class="info-value">
                <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                +62 812 - 3456 - 7890
            </div>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="contact-form-container">
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <h3 style="font-size: 1.5rem; margin-bottom: 30px;">Send us a message</h3>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.85rem; color: var(--grey);">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.85rem; color: var(--grey);">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                </div>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-size: 0.85rem; color: var(--grey);">Instrument Type</label>
                <select name="instrument" class="form-control">
                    <option>Select Instrument</option>
                    <option>Electric Guitar</option>
                    <option>Bass Guitar</option>
                    <option>Acoustic Guitar</option>
                </select>
            </div>
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-size: 0.85rem; color: var(--grey);">Message</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Tell us about your dream build..." required></textarea>
            </div>
            <button type="submit" class="btn-primary" style="margin-top: 10px;">Send Message</button>
        </form>
    </div>
</div>
@endsection