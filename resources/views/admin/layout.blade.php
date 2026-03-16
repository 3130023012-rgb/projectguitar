<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Guitar Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --bg-dark: #0a0a0a; --sidebar: #0f0f0f; --white: #fff; --grey: #888; --gold: #caa96c; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body { background: var(--bg-dark); color: var(--white); display: flex; height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 250px; background: var(--sidebar); padding: 20px; border-right: 1px solid #222; display: flex; flex-direction: column; }
        .logo { font-size: 1.2rem; font-weight: 700; margin-bottom: 40px; text-align: center; letter-spacing: 2px; }
        .nav-item { display: block; padding: 15px; color: var(--grey); text-decoration: none; border-radius: 5px; margin-bottom: 5px; }
        .nav-item:hover, .nav-item.active { background: #222; color: var(--white); }
        
        /* Main Content */
        .main { flex: 1; padding: 30px; overflow-y: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #222; }
        
        /* Cards & Tables */
        .card { background: var(--sidebar); padding: 25px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #222; }
        th { color: var(--grey); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }
        img { max-width: 100px; height: auto; border-radius: 3px; }
        
        /* Buttons */
        .btn { padding: 8px 20px; font-size: 0.8rem; text-transform: uppercase; cursor: pointer; transition: 0.3s; text-decoration: none; display: inline-block; }
        .btn-primary { background: var(--white); color: var(--black); border: 1px solid var(--white); }
        .btn-danger { background: transparent; border: 1px solid #ff4d4d; color: #ff4d4d; }
        .btn-gold { background: transparent; border: 1px solid var(--gold); color: var(--gold); }
        
        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: var(--grey); font-size: 0.9rem; }
        .form-control { width: 100%; background: var(--bg-dark); border: 1px solid #333; padding: 12px; color: var(--white); }
        .form-control:focus { outline: none; border-color: var(--gold); }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="logo">ADMIN PANEL</div>
       <!-- Di dalam <div class="sidebar"> -->
<div class="logo">ADMIN PANEL</div>

<a href="{{ route('admin.home.edit') }}" class="nav-item {{ request()->routeIs('admin.home*') ? 'active' : '' }}">
    <i class="fas fa-home"></i> Home
</a>
<a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
    <i class="fas fa-tags"></i> Categories
</a>
<a href="{{ route('admin.shop.index') }}" class="nav-item {{ request()->routeIs('admin.shop*') ? 'active' : '' }}">
    <i class="fas fa-guitar"></i> Shop
</a>
<a href="{{ route('admin.portfolio.index') }}" class="nav-item {{ request()->routeIs('admin.portfolio*') ? 'active' : '' }}">
    <i class="fas fa-images"></i> Portfolio
</a>
<a href="{{ route('admin.contact.index') }}" class="nav-item {{ request()->routeIs('admin.contact*') ? 'active' : '' }}">
    <i class="fas fa-envelope"></i> Contact
</a>

<!-- ... logout form ... -->
        <div style="margin-top: auto;">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width:100%; text-align:left; background:none; border:none; cursor:pointer;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>