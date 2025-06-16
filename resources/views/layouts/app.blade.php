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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
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
                            {{-- Estas categorías son un ejemplo estático. Luego podemos hacerlas dinámicas. --}}
                            <option value="frutas">Frutas</option>
                            <option value="verduras">Verduras</option>
                            <option value="abarrotes">Abarrotes</option>
                            <option value="lacteos">Lácteos</option>
                            <option value="carnes">Carnes</option>
                            <option value="bebidas">Bebidas</option>
                            <option value="panaderia">Panadería</option>
                            <option value="pasteleria">Pastelería</option>
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
                        <span class="ms-2 fw-bold">$0.00</span>
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
                        class="btn btn-primary text-white d-flex align-items-center px-4 py-2">
                        <i class="fas fa-home me-2"></i> HOME
                    </a>
                </div>

                {{-- Elementos del menú principal --}}
                <div class="collapse navbar-collapse justify-content-start" id="mainNavbarContent">
                    <ul class="navbar-nav">
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos', ['category' => 'frutas']) }}">FRUTAS</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos', ['category' => 'verduras']) }}">VERDURAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('productos', ['category' => 'abarrotes']) }}">ABARROTES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos', ['category' => 'lacteos']) }}">LÁCTEOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos', ['category' => 'carnes']) }}">CARNES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos', ['category' => 'bebidas']) }}">BEBIDAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('productos', ['category' => 'panaderia']) }}">PANADERÍA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('productos', ['category' => 'pasteleria']) }}">PASTELERÍA</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{-- Mensajes de sesión (success/error) --}}
            @if(session('success'))
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

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

    {{-- Botón Flotante de WhatsApp --}}
    <a href="https://whatsapp.com/channel/0029VbAjhQ9GpLHImcDJy904" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>