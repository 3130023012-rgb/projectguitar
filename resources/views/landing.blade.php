@extends('layouts.app')

@section('logo-text', "LYNN'S BASS & GUITAR")

@section('styles')
<style>
    /* CSS Khusus Landing Page */
    .hero-section { height: 100vh; background: linear-gradient(to right, rgba(0,0,0,0.9) 40%, rgba(0,0,0,0.3)), url('https://placehold.co/1920x1080/222/111?text=Hero+Guitar'); background-size: cover; display: flex; align-items: center; padding-left: 100px; }
    .hero-content h1 { font-family: 'Playfair Display', serif; font-size: 4.5rem; font-weight: 400; line-height: 1.1; margin-bottom: 30px; }
    .hero-content h1 span { display: block; font-style: italic; color: var(--gold); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; min-height: 600px; }
    .about-img { background: url('https://placehold.co/1000x800/333/222?text=About+Image'); background-size: cover; position: relative; }
    .releases-section { padding: 100px 50px; }
    .release-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .release-card { background: var(--panel-bg); height: 450px; position: relative; overflow: hidden; cursor: pointer; }
    .release-card img { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; transition: 0.5s; }
    .release-card:hover img { transform: scale(1.05); opacity: 1; }
    .release-card .tag { position: absolute; top: 20px; left: 20px; background: var(--gold); color: #000; padding: 5px 15px; font-size: 0.7rem; font-weight: 700; }
    .release-card .card-title { position: absolute; bottom: 30px; left: 20px; font-size: 1.2rem; }
    @media (max-width: 768px) { .about-grid, .release-grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>We Are The Best<br><span>Guitars Store</span><br>Since 1992</h1>
            <p style="color: #aaa; max-width: 500px; margin-bottom: 40px;">Providing high quality instruments for professionals and beginners.</p>
            <a href="{{ route('shop') }}" class="btn-primary">View Catalogue</a>
        </div>
    </div>

    <!-- About -->
<div class="about-grid">
    <!-- Ganti background image dengan asset dari setting -->
    <div class="about-img" style="background: url('{{ asset($settings['about_image'] ?? 'https://placehold.co/1000x800') }}') center/cover;"></div>
    
    <div class="about-text" style="background-color: var(--panel-bg); padding: 80px; display: flex; flex-direction: column; justify-content: center;">
        <h2 style="font-size: 2rem; margin-bottom: 20px;">{{ $settings['about_title'] ?? 'About Us' }}</h2>
        <p style="color: var(--grey); line-height: 1.8; margin-bottom: 20px;">{{ $settings['about_text'] ?? 'Default description...' }}</p>
        <button class="btn-primary" style="margin-top: 20px; width: fit-content;">Learn More</button>
    </div>
</div>
    <!-- Releases -->
<div class="releases-section">
    <div class="section-header" style="display: flex; justify-content: space-between; margin-bottom: 50px;">
        <h2 style="font-size: 1.5rem; letter-spacing: 3px; text-transform: uppercase;">Release Ars 2023</h2>
    </div>
    
    <!-- Kirim $settings dari controller nanti, atau pakai Setting::get() langsung di view -->
    @php 
        // Ambil data settings untuk release (bisa juga dikirim dari controller)
        $r1_title = $settings['release_title_1'] ?? 'Product 1';
        $r1_image = $settings['release_image_1'] ?? 'https://placehold.co/600x900/222/444?text=Product';
        $r1_tag = $settings['release_tag_1'] ?? '';

        $r2_title = $settings['release_title_2'] ?? 'Product 2';
        $r2_image = $settings['release_image_2'] ?? 'https://placehold.co/600x900/222/444?text=Product';
        $r2_tag = $settings['release_tag_2'] ?? '';

        $r3_title = $settings['release_title_3'] ?? 'Product 3';
        $r3_image = $settings['release_image_3'] ?? 'https://placehold.co/600x900/222/444?text=Product';
        $r3_tag = $settings['release_tag_3'] ?? '';
    @endphp

    <div class="release-grid">
        <!-- Item 1 -->
        <div class="release-card">
            <img src="{{ asset($r1_image) }}" alt="{{ $r1_title }}">
            @if($r1_tag)
                <span class="tag">{{ $r1_tag }}</span>
            @endif
            <div class="card-title">{{ $r1_title }}</div>
        </div>

        <!-- Item 2 -->
        <div class="release-card">
            <img src="{{ asset($r2_image) }}" alt="{{ $r2_title }}">
            @if($r2_tag)
                <span class="tag" style="background:#fff; color:#000;">{{ $r2_tag }}</span>
            @endif
            <div class="card-title">{{ $r2_title }}</div>
        </div>

        <!-- Item 3 -->
        <div class="release-card">
            <img src="{{ asset($r3_image) }}" alt="{{ $r3_title }}">
            @if($r3_tag)
                <span class="tag">{{ $r3_tag }}</span>
            @endif
            <div class="card-title">{{ $r3_title }}</div>
        </div>
    </div>
</div>
@endsection