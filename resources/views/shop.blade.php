@extends('layouts.app')

@section('logo-text', "THE MOON")

@section('styles')
<style>
    /* =========================================
       LAYOUT UTAMA
       ========================================= */
    .shop-layout {
        display: grid;
        grid-template-columns: 280px 1fr; /* Sidebar lebih ramping */
        min-height: 100vh;
        margin-top: 80px;
        background-color: #050505;
    }

    /* =========================================
       SIDEBAR KIRI (FILTER)
       ========================================= */
    .catalog-sidebar {
        background-color: #080808;
        padding: 40px 30px;
        border-right: 1px solid #1a1a1a;
        height: calc(100vh - 80px);
        position: sticky;
        top: 80px;
        overflow-y: auto;
    }

    .sidebar-title {
        color: var(--gold);
        font-size: 0.8rem;
        letter-spacing: 3px;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .filter-section {
        margin-bottom: 40px;
    }

    .filter-section h4 {
        font-size: 0.75rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }

    .filter-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .filter-list li a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        color: #555;
        text-decoration: none;
        font-size: 0.9rem;
        border-bottom: 1px solid transparent;
        transition: 0.3s;
    }

    .filter-list li a:hover,
    .filter-list li.active a {
        color: #fff;
        border-bottom-color: var(--gold);
    }

    .filter-list li.active a {
        font-weight: 600;
    }

    .count-badge {
        font-size: 0.7rem;
        background: #1a1a1a;
        color: #555;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Product Mini List in Sidebar */
    .mini-product-item {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #1a1a1a;
        cursor: pointer;
    }
    .mini-product-item:hover .mini-name { color: #fff; }
    .mini-product-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        filter: grayscale(100%);
        transition: 0.3s;
    }
    .mini-product-item:hover img { filter: grayscale(0%); }
    .mini-info { display: flex; flex-direction: column; justify-content: center; }
    .mini-name { font-size: 0.8rem; color: #666; transition: 0.3s; }
    .mini-price { font-size: 0.8rem; color: var(--gold); margin-top: 2px; }

    /* =========================================
       AREA PRODUK UTAMA (GRID)
       ========================================= */
    .product-area {
        padding: 40px 50px;
        overflow-y: auto;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #1a1a1a;
    }

    .product-count {
        color: #888;
        font-size: 0.9rem;
    }

    /* Grid Layout */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
    }

    /* Card Produk */
    .product-card {
        background: #0a0a0a;
        border: 1px solid #1a1a1a;
        padding: 15px;
        position: relative;
        cursor: pointer;
        transition: 0.4s ease;
    }

    .product-card:hover {
        border-color: var(--gold);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .card-image-wrapper {
        height: 250px;
        overflow: hidden;
        background: #111;
        margin-bottom: 15px;
        position: relative;
    }

    .card-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
        filter: grayscale(50%);
    }

    .product-card:hover img {
        transform: scale(1.1);
        filter: grayscale(0%);
    }

    .status-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--gold);
        color: #000;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
    }

    .new-badge {
        background: #fff;
    }

    .card-content h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #fff;
    }

    .card-category {
        font-size: 0.75rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .card-price {
        font-size: 1.1rem;
        color: var(--gold);
        font-family: 'Playfair Display', serif;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-quick-view {
        position: absolute;
        bottom: -50px; /* Hidden by default */
        left: 0;
        width: 100%;
        padding: 15px;
        background: #fff;
        color: #000;
        text-align: center;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
        cursor: pointer;
    }

    .product-card:hover .btn-quick-view {
        bottom: 0;
    }

    /* =========================================
       MODAL POPUP (QUICK VIEW)
       ========================================= */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        z-index: 2000;
        display: none; /* Hidden default */
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .modal-overlay.active {
        display: flex;
        opacity: 1;
    }

    .modal-content {
        background: #111;
        width: 900px;
        max-width: 95%;
        max-height: 90vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        position: relative;
        transform: scale(0.9);
        transition: transform 0.3s;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1);
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 2rem;
        color: #fff;
        cursor: pointer;
        z-index: 10;
        line-height: 1;
    }

    .modal-image {
        height: 100%;
        background: #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .modal-info {
        padding: 50px 40px;
        overflow-y: auto;
        color: #fff;
    }

    .modal-title {
        font-size: 2.5rem;
        font-weight: 300;
        margin-bottom: 10px;
        line-height: 1.1;
    }

    .modal-price {
        font-size: 1.8rem;
        color: var(--gold);
        margin-bottom: 30px;
        font-family: 'Playfair Display', serif;
    }

    .specs-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }
    .specs-table tr { border-bottom: 1px solid #222; }
    .specs-table td { padding: 12px 0; font-size: 0.9rem; }
    .specs-table td:first-child { color: #666; width: 40%; text-transform: uppercase; font-size: 0.8rem;}
    .specs-table td:last-child { color: #ccc; text-align: right; }

    .modal-desc {
        color: #888;
        line-height: 1.8;
        margin-bottom: 30px;
        font-size: 0.95rem;
    }

    .btn-modal-buy {
        width: 100%;
        padding: 18px;
        background: var(--gold);
        color: #000;
        border: none;
        text-transform: uppercase;
        font-weight: 700;
        cursor: pointer;
        font-size: 0.9rem;
        letter-spacing: 2px;
        transition: 0.3s;
    }
    .btn-modal-buy:hover { background: #fff; }

    /* Responsive */
    @media (max-width: 1000px) {
        .shop-layout { grid-template-columns: 1fr; }
        .catalog-sidebar { display: none; }
        .modal-content { grid-template-columns: 1fr; height: auto; }
        .modal-image { height: 300px; }
    }
</style>
@endsection

@section('content')
<div class="shop-layout">
    
    <!-- ================= KIRI: SIDEBAR ================= -->
    <div class="catalog-sidebar">
        <div class="sidebar-title">CATALOGUE</div>

        <!-- Filter Kategori -->
        <div class="filter-section">
            <h4>Categories</h4>
            <ul class="filter-list">
                <li class="{{ !$activeCategory ? 'active' : '' }}">
                    <a href="{{ route('shop') }}">
                        <span>All Products</span> 
                        <span class="count-badge">{{ \App\Models\Product::count() }}</span>
                    </a>
                </li>
                @foreach($categories as $cat)
                    <li class="{{ $activeCategory == $cat->id ? 'active' : '' }}">
                        <a href="{{ route('shop', ['category' => $cat->id]) }}">
                            <span>{{ $cat->name }}</span> 
                            <span class="count-badge">{{ $cat->products_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Top Sales Mini List -->
        <div class="filter-section">
            <h4>On Sale</h4>
            @foreach($saleProducts as $item)
                <div class="mini-product-item" onclick="openQuickView({{ $item->id }})">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                    <div class="mini-info">
                        <div class="mini-name">{{ Str::limit($item->name, 20) }}</div>
                        <div class="mini-price">${{ number_format($item->price, 2) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ================= KANAN: PRODUCT GRID ================= -->
    <div class="product-area">
        
        <div class="product-header">
            <div>
                <h2 style="font-size: 1.5rem; font-weight: 300; text-transform: uppercase; letter-spacing: 2px;">
                    {{ $activeCategory ? App\Models\Category::find($activeCategory)->name : 'All Guitars' }}
                </h2>
                <div class="product-count">{{ $products->total() }} Products found</div>
            </div>
        </div>

        <div class="product-grid">
            @foreach($products as $item)
                <div class="product-card" onclick="openQuickView({{ $item->id }})">
                    <div class="card-image-wrapper">
                        @if($item->status == 'sale')
                            <span class="status-badge">Sale</span>
                        @elseif($item->is_new)
                            <span class="status-badge new-badge">New</span>
                        @endif
                        
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                    </div>
                    <div class="card-content">
                        <div class="card-category">{{ $item->category->name ?? 'Uncategorized' }}</div>
                        <h3>{{ $item->name }}</h3>
                        <div class="card-price">
                            ${{ number_format($item->price, 2) }}
                        </div>
                    </div>
                    <!-- Quick View Button Overlay -->
                    <div class="btn-quick-view">
                        Quick View
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: 50px; text-align: center;">
            {{ $products->links() }}
        </div>

    </div>
</div>

<!-- ================= MODAL QUICK VIEW ================= -->
<div id="quickViewModal" class="modal-overlay">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        
        <!-- Kiri: Gambar -->
        <div class="modal-image">
            <img id="modal-img" src="" alt="Product Image">
        </div>

        <!-- Kanan: Info -->
        <div class="modal-info">
            <div id="modal-category" style="font-size: 0.8rem; color: var(--gold); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;"></div>
            <h1 id="modal-title" class="modal-title"></h1>
            <div id="modal-price" class="modal-price"></div>

            <h3 style="margin-bottom:15px; border-left: 3px solid var(--gold); padding-left:15px; text-transform:uppercase; font-size:0.9rem;">Characteristics</h3>
            
            <table id="modal-specs" class="specs-table">
                <!-- Isi via JS -->
            </table>

            <p id="modal-desc" class="modal-desc"></p>

            <!-- Tombol Add to Cart -->
            <button class="btn-modal-buy" id="btn-add-cart" data-id="">Add to Cart</button>
        </div>
    </div>
</div>

<script>
    // 1. Inisialisasi variabel tombol
    const addToCartBtn = document.getElementById('btn-add-cart');
    const modal = document.getElementById('quickViewModal');

    // 2. Fungsi Buka Modal
    function openQuickView(id) {
        // Fetch data via AJAX
        fetch(`/product/${id}`)
            .then(response => response.json())
            .then(data => {
                // Isi data ke modal
                document.getElementById('modal-img').src = `/${data.image}`;
                document.getElementById('modal-title').innerText = data.name;
                document.getElementById('modal-category').innerText = data.category ? data.category.name : 'Uncategorized';
                document.getElementById('modal-price').innerText = '$' + parseFloat(data.price).toFixed(2);
                document.getElementById('modal-desc').innerText = data.description || 'No description available.';
                
                // Handle Specs
                const specsTable = document.getElementById('modal-specs');
                specsTable.innerHTML = '';
                
                // Check if specs is string (JSON) or object
                let specs = data.specs;
                if (typeof specs === 'string') {
                    try { specs = JSON.parse(specs); } catch (e) { specs = {}; }
                }

                if (specs && Object.keys(specs).length > 0) {
                    for (const [key, value] of Object.entries(specs)) {
                        const row = `<tr><td>${key}</td><td>${value}</td></tr>`;
                        specsTable.innerHTML += row;
                    }
                } else {
                    specsTable.innerHTML = '<tr><td colspan="2" style="text-align:center; color:#555;">No specs</td></tr>';
                }

                // SET ID PRODUK KE TOMBOL (PENTING)
                addToCartBtn.setAttribute('data-id', id);

                // Tampilkan modal
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scroll
            })
            .catch(error => console.error('Error:', error));
    }

    // 3. Fungsi Tutup Modal
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = 'auto'; // Enable scroll
    }

    // 4. Event Listener untuk Tombol Add to Cart
    addToCartBtn.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        
        // Cek login sederhana (opsional, di Laravel biasanya cek middleware)
        // Jika ingin aman, route cart.add sudah dilindungi middleware auth
        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('Produk berhasil ditambahkan ke keranjang!');
                closeModal();
            } else {
                // Jika error (misal belum login)
                if(data.message) {
                    alert(data.message);
                } else {
                    alert('Terjadi kesalahan.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menambahkan produk. Pastikan Anda sudah login.');
        });
    });

    // Close modal if clicked outside
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection