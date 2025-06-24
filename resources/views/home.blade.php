@extends('layouts.app')

@section('content')

{{-- BANNERS PRINCIPALES --}}
{{-- El padding y max-width para esta sección se controlan en el CSS global con .main-banners-section --}}
<div class="container-fluid main-banners-section mt-3 mb-4">
    <div class="row gx-3 gy-3 align-items-stretch"> {{-- Ajustado gx-3 gy-3 para consistencia global --}}
        
        {{-- Columna para el BANNER VERTICAL (izquierda) --}}
        <div class="col-lg-3 col-md-4 col-12"> {{-- Ajuste col-md-4 para mejor balance en tablets --}}
            {{-- APLICAMOS 'banner-vertical' --}}
            <div class="banner-vertical position-relative rounded shadow-sm overflow-hidden h-100"> 
                {{-- **AJUSTA ESTA RUTA DE IMAGEN SI ES NECESARIO** --}}
                <img src="{{ asset('images/banners/banner_vertical.png') }}" class="img-fluid w-100 h-100" alt="Ahorra con Tottus">
                <div class="banner-content banner-content-left p-3">
                    
                </div>
            </div>
        </div>

        {{-- Columna para los BANNERS HORIZONTALES (derecha) --}}
        <div class="col-lg-9 col-md-8 col-12"> {{-- Ajuste col-md-8 para mejor balance en tablets --}}
            <div class="row gx-3 gy-3"> {{-- Unificado gx-3 gy-3 --}}
                
                {{-- BANNER SUPERIOR HORIZONTAL --}}
                <div class="col-12">
                    {{-- APLICAMOS 'banner-horizontal' --}}
                    <div class="banner-horizontal position-relative rounded shadow-sm overflow-hidden"> 
                        {{-- **AJUSTA ESTA RUTA DE IMAGEN SI ES NECESARIO** --}}
                        <img src="{{ asset('images/banners/banner_verticalgrande.png') }}" class="img-fluid w-100" alt="Oferta Especial">
                        <div class="banner-content banner-content-center p-3 text-white d-flex flex-column justify-content-center align-items-center h-100 w-100"> 
                            {{-- Contenido del banner horizontal (botones, texto, etc.) --}}
                            {{-- Si el texto y botón no se ven bien sobre la imagen, considera quitar la clase text-white o ajustarla en custom.css --}}
                            {{-- Mantengo el botón aquí, si no quieres texto, puedes remover los <p> --}}
                            {{-- NOTA: El 20% y OFERTA se posicionarán con el CSS de discount-circle --}}
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-shop-now mt-auto mb-3">OFERTAS <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                        {{-- El círculo de descuento lo dejamos fuera del banner-content porque su posición es absoluta --}}
                        <div class="discount-circle position-absolute top-3 end-0 m-3">
                            <span class="d-block text-center sale-text">¡OFERTA!</span>
                            <span class="d-block text-center percent-text">20%</span>
                        </div>
                    </div>
                </div>

                {{-- Carrusel para el BANNER INFERIOR HORIZONTAL --}}
                <div class="col-12 mt-2">
                    <div id="bottomBannerCarousel" class="carousel slide rounded shadow-sm overflow-hidden" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            
                            {{-- **AJUSTA ESTAS RUTAS DE IMAGEN SI ES NECESARIO** --}}
                            <div class="carousel-item active">
                                <img src="{{ asset('images/banners/banner1.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta Delivery Gratis">
                                
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner2.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Promoción Especial">
                               
                                    
                            
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner3.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                           
                                   
                                
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner4.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                
                                   
                                
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner5.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                
                                   
                                
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

            </div> {{-- Fin .row gx-3 gy-3 para banners horizontales --}}
        </div> {{-- Fin .col-lg-9 --}}
    </div> {{-- Fin .row gx-3 gy-3 banners principales --}}
</div> {{-- Fin .container-fluid main-banners-section --}}


{{-- SECCIÓN "Nuestras Categorías" --}}
<div class="container-fluid fruit-categories-section mt-5 mb-5">
    <h2 class="text-center mb-4">Nuestras Categorías</h2>
    <div class="row gx-3 align-items-stretch"> {{-- align-items-stretch es bueno aquí --}}
        
        {{-- Columna izquierda: Banner grande "Fresh Fruits" --}}
        <div class="col-lg-6 col-md-6 col-12">
            {{-- Aseguramos h-100 en el banner interno --}}
            <div class="fruit-category-banner position-relative rounded shadow-sm overflow-hidden h-100">
                <img src="{{ asset('images/banners/bannercuadrado_frutas.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Fresh Fruits Best Prices">
                <div class="banner-overlay-text text-white p-3">
                    <h3 class="fw-bold mb-0">Fresh Fruits</h3>
                    <p class="lead">Best Prices</p>
                    <a href="{{ route('productos', ['category' => 2]) }}" class="btn btn-light btn-sm mt-2">Ver Frutas</a>
                </div>
            </div>
        </div>

        {{-- Columna derecha: Cuadrícula de iconos Y banner horizontal --}}
        <div class="col-lg-6 col-md-6 col-12 d-flex flex-column"> {{-- AÑADIDO: d-flex flex-column aquí --}}
            <div class="row g-3 flex-grow-1"> {{-- AÑADIDO: flex-grow-1 aquí --}}
                {{-- Fila superior: Cuadrícula de categorías/frutas --}}
                <div class="col-12">
                    {{-- Aseguramos h-100 para que ocupe el espacio disponible, si no lo hace, ajustaremos su altura --}}
                    <div class="small-icon-grid card shadow-sm border-0 rounded h-100 p-3">
                        <div class="row row-cols-3 row-cols-sm-4 row-cols-md-4 row-cols-lg-4 g-2 text-center">
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
                                    ['name' => 'Blueberries', 'icon' => 'fa-seedling', 'color' => 'text-primary'],
                                    ['name' => 'Cabbages', 'icon' => 'fa-leaf', 'color' => 'text-success'],
                                    ['name' => 'Cherries', 'icon' => 'fa-seedling', 'color' => 'text-danger'],
                                    ['name' => 'Figs', 'icon' => 'fa-seedling', 'color' => 'text-purple'],
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
                <div class="col-12 mt-3"> {{-- Considera si este mt-3 es el que desalinea --}}
                    <div class="citrus-banner position-relative rounded shadow-sm overflow-hidden">
                        <img src="{{ asset('images/banners/horizontal_bannerfrutas.png') }}" class="img-fluid w-100" alt="Citrus Festivals 2016">
                        <div class="banner-overlay-text text-white p-4">
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

{{-- SECCIÓN DE PRODUCTOS DESTACADOS --}}
{{-- Sección de productos destacados ahora usa el mismo max-width y padding que los banners --}}
<div class="container-fluid productos-destacados mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Productos Destacados</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4"> {{-- Añadido g-4 para gap entre tarjetas --}}
                @foreach($featuredProducts as $product)
                    <div class="col">
                        {{-- APLICAMOS 'product-card' --}}
                        <div class="product-card card h-100 shadow-sm rounded">
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
                                <a href="{{ route('productos.show', $product) }}" class="btn btn-outline-primary btn-sm mt-auto">Ver Detalles</a> {{-- Añadido mt-auto para alinear el botón abajo --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN ZONA DE DESCUENTOS VISUALES --}}
{{-- Esta sección ahora usa las clases y paddings de .zona-descuentos definidos en el CSS --}}
<div class="container-fluid zona-descuentos mt-5 mb-5">
    <h2 class="text-center">Grandes Descuentos</h2>
    <div class="descuentos-grid">
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento1.jpg') }}" alt="Descuento 1">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento2.jpg') }}" alt="Descuento 2">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento3.jpg') }}" alt="Descuento 3">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento4.jpg') }}" alt="Descuento 4">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento5.jpg') }}" alt="Descuento 5">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuentos/descuento6.jpg') }}" alt="Descuento 6">
            </a>
        </div>
    </div>
</div>


{{-- SECCIÓN UNETE A NUESTRA COMUNIDAD --}}
<div class="container-fluid mt-5 mb-5 py-5 bg-light"> {{-- Añadido container-fluid, py-5 y bg-light para un look más moderno --}}
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="mb-4">Únete a Nuestra Comunidad</h2>
            <p class="lead mb-4">Suscríbete para recibir nuestras últimas ofertas y novedades</p>
            <form class="row justify-content-center">
                <div class="col-md-6 col-lg-4"> {{-- Ajustado el tamaño de la columna para el formulario --}}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Tu correo electrónico" aria-label="Tu correo electrónico" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Suscribirse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection