<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Si deseas usar una fuente más "orgánica" como la del ejemplo, puedes añadirla aquí, por ejemplo: --}}
    {{--
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet"> --}}

    {{-- ACTUALIZADO: Bootstrap CSS a la última versión estable (5.3.3 en este caso) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- ACTUALIZADO: Font Awesome a la última versión estable (6.5.2 en este caso) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Deja app.css si lo usas para estilos generales de Laravel/Vite, pero custom.css será para los tuyos --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Asegúrate de que esta línea esté presente y apunte a tu custom.css --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div id="app">
        {{-- TOP BAR (BARRA SUPERIOR) --}}
        {{-- Visible en tabletas y escritorio (d-md-block), oculta en móviles (d-none) --}}
        <div class="top-bar py-2 d-none d-md-block">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="top-left-info">
                    <span>Envío GRATIS en compras superiores a S/100</span>
                </div>
                <div class="top-right-links d-flex align-items-center">
                    <ul class="list-inline mb-0">
                        @guest
                            @if (Route::has('login'))
                                <li class="list-inline-item me-3">
                                    <a class="text-dark text-decoration-none" href="{{ route('login') }}"><i
                                            class="fas fa-sign-in-alt me-1"></i> {{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="list-inline-item">
                                    <a class="text-dark text-decoration-none" href="{{ route('register') }}"><i
                                            class="fas fa-user-plus me-1"></i> {{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="list-inline-item dropdown">
                                <a class="text-dark text-decoration-none dropdown-toggle" href="#"
                                    id="navbarDropdownUserTop" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownUserTop">
                                    <li><a class="dropdown-item" href="{{ route('perfil') }}">Mi Perfil</a></li>
                                    {{-- Asume que tienes una función isAdmin() en tu modelo User o un Gate --}}
                                    @if(Auth::user()->isAdmin())
                                        <li><a class="dropdown-item" href="{{ route('admin') }}">Panel Admin</a></li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>

        {{-- MAIN HEADER (LOGO, BARRA DE BÚSQUEDA, ÍCONOS DE CARRITO) --}}
        <header class="main-header py-3">
            <div class="container d-flex justify-content-between align-items-center">
                {{-- Logo --}}
                <div class="logo-area text-center">
                    <a class="navbar-brand d-block" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo/tottus_logo1.png') }}" alt="{{ config('app.name', 'TOTTUS') }}"
                            style="height: 60px;">
                        <h4 class="mb-0" style="color: #6A994E;">Alimentos Frescos</h4> {{-- Slogan --}}
                    </a>
                </div>

                {{-- Barra de Búsqueda --}}
                <div class="search-bar flex-grow-1 mx-4">
                    <form action="{{ route('productos') }}" method="GET" class="input-group">
                        <select class="form-select" name="category" aria-label="Category">
                            <option value=""> Categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" name="search" placeholder="Buscar productos..."
                            aria-label="Buscar productos">
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                {{-- Íconos (Carrito de Compras) --}}
                <div class="header-icons d-flex align-items-center">
                    <div class="cart-icon position-relative">
                        <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            {{-- Asume que tienes una forma de obtener el conteo de ítems del carrito, por ejemplo con
                            una Session o un View Composer --}}
                            <span
                                class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle"
                                style="font-size: 0.6em;">0</span>
                        </a>
                        {{-- Asume que tienes una forma de obtener el total del carrito --}}
                        <span class="ms-2 fw-bold">S/{{ isset($cart) && $cart->items->count() ? number_format($cart->items->sum(function($item){ return $item->price * $item->quantity; }), 2) : '0.00' }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- MAIN NAVIGATION BAR (BARRA DE NAVEGACIÓN PRINCIPAL) --}}
        {{-- sticky-top para que se quede fija al hacer scroll --}}
        <nav class="main-nav-bar navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container">
                {{-- Botón para móviles (toggler) --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbarContent" aria-controls="mainNavbarContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Botón "Shop Categories" (visible solo en pantallas grandes) --}}
                <div class="shop-categories-btn d-none d-lg-block me-4">
                    <a href="{{ route('home') }}"
                        class="btn btn-success text-white d-flex align-items-center px-4 py-2">
                        <i class="fas fa-home me-2"></i> HOME
                    </a>
                </div>

                {{-- Elementos del menú principal --}}
                <div class="collapse navbar-collapse justify-content-start" id="mainNavbarContent">
                    <ul class="navbar-nav"> 				
                        @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('productos', ['category' => $category->id]) }}">
                                    {{ strtoupper($category->name) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            {{-- Mensajes de sesión (success/error) --}}
            {{-- @if(session('success'))
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif --}}

            @if(session('error'))
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            {{-- Contenido de la página (lo que viene de otras vistas, como home.blade.php) --}}
            @yield('content')
        </main>
    </div> {{-- Cierre de #app --}}

    <footer class="footer-minimalist py-5">
        <div class="container">
            <div class="row align-items-start gy-4">
                <!-- Logo e info -->
                <div class="col-lg-3 col-md-6">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo/tottus_logo1.png') }}" alt="Tottus" style="height: 48px;">
                    </div>
                    <div class="mb-2 text-muted small">Llámanos gratis 24/7</div>
                    <div class="fw-bold text-success mb-3" style="font-size:1.2em;">(01) 595-0000</div>
                    <div class="d-flex gap-2">
                        <a href="https://facebook.com/TottusPeru" class="footer-social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/tottusperu" class="footer-social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com" class="footer-social-link" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="https://whatsapp.com/channel/0029VbAjhQ9GpLHImcDJy904" class="footer-social-link" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Contacto -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-title">Contacto</div>
                    <div class="footer-underline mb-3"></div>
                    <div class="small text-muted mb-1">Dirección: Lima, Perú</div>
                    <div class="small text-muted mb-1">Teléfono: (01) 595-0000</div>
                    <div class="small text-muted mb-2">Correo: info@tottus.com.pe</div>
                    <div class="d-flex gap-2 mt-2">
                        <a href="https://facebook.com/TottusPeru" class="footer-social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/tottusperu" class="footer-social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <!-- Quicklinks -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-title">Enlaces rápidos</div>
                    <div class="footer-underline mb-3"></div>
                    <div class="row">
                        <div class="col-6">
                            <ul class="footer-list">
                                <li><a href="#">Nuestra Marca</a></li>
                                <li><a href="#">Términos de uso</a></li>
                                <li><a href="#">Ayuda & FAQ</a></li>
                                <li><a href="#">Servicios</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="footer-list">
                                <li><a href="{{ route('perfil') }}">Mi Cuenta</a></li>
                                <li><a href="{{ route('register') }}">Registrarse</a></li>
                                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Redes Sociales -->
                <div class="col-lg-3 col-md-6 d-flex flex-column align-items-end justify-content-center">
                    <div class="footer-title mb-3 text-end w-100">Síguenos en nuestras redes</div>
                    <div class="footer-social-vertical d-flex flex-column align-items-end gap-4" style="min-height: 180px;">
                        <a href="https://whatsapp.com/channel/0029VbAjhQ9GpLHImcDJy904" class="footer-social-name whatsapp-name" target="_blank">WhatsApp</a>
                        <a href="https://facebook.com/TottusPeru" class="footer-social-name facebook-name" target="_blank">Facebook</a>
                        <a href="https://instagram.com/tottusperu" class="footer-social-name instagram-name" target="_blank">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center small text-muted">
                    Copyright © {{ date('Y') }} Tottus. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </footer>

    {{-- Botón Flotante de WhatsApp --}}
    <div class="social-float-buttons">
        <a href="https://whatsapp.com/channel/0029VbAjhQ9GpLHImcDJy904" class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/TottusPeru" class="facebook-float" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/tottusperu/" class="instagram-float" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    </div>

    {{-- Toast flotante para agregar al carrito -->
    <div id="cart-toast" style="display:none; position:fixed; left:50%; transform:translateX(-50%); bottom:40px; z-index:9999; min-width:320px; background:#28a745; color:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:18px 32px; font-size:1.25em; font-weight:bold; text-align:center;">
        Se agregó al carrito.
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token'),
                    },
                    body: formData
                })
                .then(res => res.ok ? res.json().catch(()=>({success:true})) : Promise.reject(res))
                .then(data => {
                    showCartToast();
                })
                .catch(() => {
                    showCartToast('No se pudo agregar el producto', true);
                });
            });
        });
    });
    function showCartToast(msg = 'Se agregó al carrito.', error = false) {
        const toast = document.getElementById('cart-toast');
        toast.textContent = msg;
        toast.style.background = error ? '#dc3545' : '#28a745';
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
    </script>

    {{-- ACTUALIZADO: Bootstrap JS a la última versión estable --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    
    
</body>

</html>