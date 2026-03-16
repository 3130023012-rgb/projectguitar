<nav id="navbar" style="position: fixed; top: 0; width: 100%; height: 80px; display: flex; justify-content: space-between; align-items: center; padding: 0 50px; z-index: 999; background-color: rgba(10, 10, 10, 0.95); border-bottom: 1px solid var(--border-color);">
    <div class="logo" style="font-size: 1.5rem; font-weight: 700; letter-spacing: 4px; text-transform: uppercase;">
        <a href="{{ route('landing') }}" style="color: var(--white); text-decoration: none;">
            @yield('logo-text', "LYNN'S BASS & GUITAR")
        </a>
    </div>
    <ul class="nav-menu" style="display: flex; gap: 40px; list-style: none;">
 <ul class="nav-menu" style="display: flex; gap: 40px; list-style: none;">
    <li><a href="{{ route('landing') }}" style="color: var(--white); text-decoration: none; font-size: 0.85rem; text-transform: uppercase;">Home</a></li>
    <li><a href="{{ route('shop') }}" style="color: var(--white); text-decoration: none; font-size: 0.85rem; text-transform: uppercase;">Shop</a></li>
    
    <!-- TAMBAHKAN INI -->
    <li><a href="{{ route('portfolio') }}" style="color: var(--white); text-decoration: none; font-size: 0.85rem; text-transform: uppercase;">Portfolio</a></li>
    
    <li><a href="{{ route('contact') }}" style="color: var(--white); text-decoration: none; font-size: 0.85rem; text-transform: uppercase;">Contact</a></li>
</ul>
    <button class="nav-btn" style="padding: 10px 25px; border: 1px solid var(--white); background: transparent; color: var(--white); text-transform: uppercase; font-size: 0.8rem; cursor: pointer;">Start Your Build</button>
</nav>