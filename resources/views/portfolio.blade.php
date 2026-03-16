@extends('layouts.app')

@section('logo-text', "LYNN'S BASS & GUITAR")

@section('styles')
<style>
    /* CSS Khusus Portfolio */
    .portfolio-section {
        padding: 120px 50px 80px; /* Offset for navbar */
        background-color: var(--black-bg);
        min-height: 100vh;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h1 {
        font-size: 3rem;
        font-weight: 300;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .section-header p {
        color: var(--grey);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Kolom */
        gap: 25px;
    }

    .portfolio-item {
        position: relative;
        overflow: hidden;
        background: var(--panel-bg);
        height: 400px;
        cursor: pointer;
    }

    .portfolio-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease, opacity 0.5s ease;
        opacity: 0.8;
    }

    /* Efek Hover */
    .portfolio-item:hover img {
        transform: scale(1.1);
        opacity: 0.3;
    }

    .portfolio-info {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .portfolio-item:hover .portfolio-info {
        opacity: 1;
    }

    .portfolio-info h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .portfolio-item:hover .portfolio-info h3 {
        transform: translateY(0);
    }

    .portfolio-info span {
        color: var(--gold);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.1s;
    }

    .portfolio-item:hover .portfolio-info span {
        transform: translateY(0);
    }
    
    .portfolio-info p {
        color: #ddd;
        font-size: 0.9rem;
        transform: translateY(20px);
        transition: transform 0.4s ease 0.2s;
    }

    .portfolio-item:hover .portfolio-info p {
        transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .portfolio-grid { grid-template-columns: 1fr; }
        .portfolio-item { height: 350px; }
    }
</style>
@endsection

@section('content')
<div class="portfolio-section">
    <div class="container">
        <div class="section-header">
            <h1>Our Work</h1>
            <p>A showcase of our craftsmanship. Custom builds, repairs, and restorations done with passion.</p>
        </div>

        <div class="portfolio-grid">
            @foreach($projects as $item)
                <div class="portfolio-item">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <div class="portfolio-info">
                        <span>{{ $item['category'] }}</span>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection