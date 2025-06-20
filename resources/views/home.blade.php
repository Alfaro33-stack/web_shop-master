@extends('layouts.app')

@section('content')
{{-- BANNERS PRINCIPALES --}}
<div class="container-fluid px-0">
    <div class="row gx-2 gy-2"> 
        
        {{-- Columna para el BANNER VERTICAL (izquierda) --}}
        <div class="col-lg-4 col-md-5">
            <div class="banner-vertical position-relative">
                <img src="{{ asset('images/banners/banner_vertical.png') }}" class="img-fluid w-100" alt="Ahorra con Tottus">
                <div class="banner-content banner-content-left p-3">
                    <p class="small-text">Ahorra con</p>
                    <h2 class="title-text">TOTTUS</h2>
                    <p class="bottom-text">ahora en PedidosYa</p>
                </div>
            </div>
        </div>

        {{-- Columna para los BANNERS HORIZONTALES (derecha) --}}
        <div class="col-lg-8 col-md-7">
            <div class="row gx-2 gy-2"> 
                
                {{-- BANNER SUPERIOR HORIZONTAL --}}
                <div class="col-12">
                    <div class="banner-horizontal position-relative"> 
                        <img src="{{ asset('images/banners/banner_verticalgrande.png') }}" class="img-fluid w-100" alt="Oferta Especial">
                        <div class="banner-content banner-content-center p-3 text-white">                           
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-shop-now">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                            <div class="discount-circle position-absolute top-0 end-0 me-3 mt-3">
                                <span class="d-block text-center sale-text">¡OFERTA!</span>
                                <span class="d-block text-center percent-text">20%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carrusel para el BANNER INFERIOR HORIZONTAL --}}
                <div class="col-12 mt-2">
                    <div id="bottomBannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner rounded">
                            
                            <div class="carousel-item active">
                                <img src="{{ asset('images/banners/banner1.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta Delivery Gratis">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>DELIVERY GRATIS</h5>
                                    <p>En todo kekes y tartas con todo medio de pago</p>
                                    <a href="#" class="btn btn-success btn-sm">VER TODO</a>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner2.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Promoción Especial">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>¡Nuevos Postres!</h5>
                                    <p>Descubre nuestra variedad de dulces.</p>
                                    <a href="#" class="btn btn-warning btn-sm">Explorar</a>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner3.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner4.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner5.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>
                    </div>
                </div>

            </div> {{-- Fin .row gx-2s gy-2 para banners horizontales --}}
        </div> {{-- Fin .col-lg-8 --}}
    </div> {{-- Fin .row gx-3 gy-3 banners principales --}}
</div> {{-- Fin .container-fluid --}}


{{-- SECCIÓN "Nuestras Categorías" con el banner grande de frutas, la cuadrícula de iconos y el banner horizontal --}}
<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Nuestras Categorías</h2>
    <div class="row g-3"> 
        
        {{-- Columna izquierda: Banner grande "Fresh Fruits" --}}
        <div class="col-lg-6">
            <div class="position-relative overflow-hidden rounded shadow-sm h-100 fruit-banner-left">
                <img src="{{ asset('images/banners/bannercuadrado_frutas.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Fresh Fruits Best Prices">
                <div class="position-absolute top-50 start-0 translate-middle-y text-white p-3 banner-overlay-text">
                    <h3 class="fw-bold mb-0">Fresh Fruits</h3>
                    <p class="lead">Best Prices</p>
                    <a href="{{ route('productos', ['category' => 2]) }}" class="btn btn-light btn-sm mt-2">Ver Frutas</a>
                </div>
            </div>
        </div>

        {{-- Columna derecha: Cuadrícula de iconos Y banner horizontal --}}
        <div class="col-lg-6">
            <div class="row g-3">
                {{-- Fila superior: Cuadrícula de categorías/frutas (los "cuadrados tipo Excel") --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded h-100 p-3">
                        <div class="row row-cols-3 row-cols-md-4 g-2 text-center small-icon-grid">
                            {{-- Items de la cuadrícula --}}
                            @php
                                $fruitCategories = [
                                    ['name' => 'Apple', 'icon' => 'fa-apple-alt', 'color' => 'text-danger'],
                                    ['name' => 'Avocado', 'icon' => 'fa-leaf', 'color' => 'text-success'],
                                    ['name' => 'Banana', 'icon' => 'fa-lemon', 'color' => 'text-warning'],
                                    ['name' => 'Beans', 'icon' => 'fa-seedling', 'color' => 'text-success'],
                                    ['name' => 'Beef', 'icon' => 'fa-drumstick-bite', 'color' => 'text-secondary'],
                                    ['name' => 'Beverages Box', 'icon' => 'fa-box', 'color' => 'text-info'],
                                    ['name' => 'Broccoli', 'icon' => 'fa-carrot', 'color' => 'text-success'],
                                    ['name' => 'Blueberries', 'icon' => 'fa-blueberries', 'color' => 'text-primary'],
                                    ['name' => 'Cabbages', 'icon' => 'fa-leaf', 'color' => 'text-success'],
                                    ['name' => 'Cherries', 'icon' => 'fa-cherry', 'color' => 'text-danger'],
                                    ['name' => 'Figs', 'icon' => 'fa-fig', 'color' => 'text-purple'],
                                ];
                            @endphp

                            @foreach($fruitCategories as $item)
                                <div class="col">
                                    <a href="#" class="d-block text-decoration-none text-dark py-2">
                                        <i class="fas {{ $item['icon'] }} fa-lg {{ $item['color'] }} mb-1"></i><br>
                                        <span class="small">{{ $item['name'] }}</span>
                                    </a>
                                </div>
                            @endforeach
                            <div class="col">
                                <a href="{{ route('productos', ['category' => 2]) }}" class="d-block text-decoration-none text-dark py-2">
                                    <i class="fas fa-plus-circle fa-lg text-muted mb-1"></i><br>
                                    <span class="small">Explore more ></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Fila inferior: Banner "Citrus Festivals 2016" --}}
                <div class="col-12 mt-3"> 
                    <div class="position-relative overflow-hidden rounded shadow-sm citrus-banner">
                        <img src="{{ asset('images/banners/horizontal_bannerfrutas.png') }}" class="img-fluid w-100" alt="Citrus Festivals 2016">
                        <div class="position-absolute top-50 start-0 translate-middle-y text-white p-4 banner-overlay-text">
                            <h3 class="fw-bold mb-1">Citrus Festivals 2016</h3>
                            <p class="lead mb-2">22/1/2016</p> 
                            <a href="{{ route('productos', ['category' => 2]) }}" class="btn btn-success btn-sm">BUY NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN DE PRODUCTOS DESTACADOS (sombreados en amarillo en la imagen anterior) --}}
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Productos Destacados</h2>
            <div class="row">
                @foreach($featuredProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm rounded product-card">
                            <div class="position-relative">
                                @if($product->image)
                                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top rounded-top" alt="{{ $product->name }}">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center rounded-top" style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                @if(isset($product->is_sale) && $product->is_sale) 
                                    <span class="badge bg-success position-absolute top-0 start-0 m-2">Sale!</span>
                                @endif
                                @if(isset($product->is_hot) && $product->is_hot)
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Hot</span>
                                @endif
                            </div>
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <h5 class="card-title mb-1">{{ $product->name }}</h5>
                                <p class="card-text text-muted mb-2">${{ number_format($product->price, 2) }}</p>
                                <div class="text-warning small mb-2">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <a href="{{ route('productos.show', $product) }}" class="btn btn-outline-primary btn-sm">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN OFERTAS ESPECIALES --}}
<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Ofertas Especiales</h2>
            <div class="row">
                @for($i = 1; $i <= 3; $i++)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Oferta {{ $i }}</h5>
                                <p class="card-text">Descuento especial en productos seleccionados.</p>
                                <p class="card-text"><strong>Hasta 50% OFF</strong></p>
                                <a href="#" class="btn btn-danger">Ver Oferta</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN UNETE A NUESTRA COMUNIDAD --}}
<div class="container mb-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="mb-4">Únete a Nuestra Comunidad</h2>
            <p class="lead mb-4">Suscríbete para recibir nuestras últimas ofertas y novedades</p>
            <form class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Tu correo electrónico">
                        <button class="btn btn-primary" type="submit">Suscribirse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection