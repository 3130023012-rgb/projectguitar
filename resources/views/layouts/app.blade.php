<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Store - Laravel</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- CSS VARIABLES & RESET --- */
        :root {
            --black-bg: #0a0a0a; --panel-bg: #0f0f0f; --white: #ffffff;
            --grey: #888888; --dark-grey: #333333; --gold: #caa96c;
            --border-color: #222222; --green-whatsapp: #25D366;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--black-bg); color: var(--white);
            overflow-x: hidden;
        }

        /* --- GLOBAL COMPONENTS --- */
        .btn-primary {
            background-color: var(--white); color: var(--black-bg);
            padding: 15px 40px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 2px; border: none; cursor: pointer; transition: all 0.3s;
            text-decoration: none; display: inline-block;
        }
        .btn-primary:hover { background-color: var(--gold); }
        
        /* --- RESPONSIVE GLOBAL --- */
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr !important; text-align: center; }
            .footer-about p { margin: 0 auto !important; }
        }
    </style>

    <!-- Inject Styles dari halaman spesifik -->
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Konten Utama Halaman -->
    @yield('content')

    <!-- Footer -->
    @if(!request()->routeIs('shop'))
        @include('partials.footer')
    @endif

    <!-- Floating WhatsApp -->
    @include('partials.floating-wa')

    <!-- Inject Scripts -->
    @yield('scripts')
</body>
</html>