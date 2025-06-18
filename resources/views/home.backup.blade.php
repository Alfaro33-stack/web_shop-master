@extends('layouts.app')

@section('content')
{{-- BANNERS PRINCIPALES --}}
<div class="container-fluid px-0">
    {{-- Usamos container-fluid y px-0 para que los banners se extiendan por todo el ancho --}}
    {{-- CAMBIO CRÍTICO AQUÍ: Añadimos 'gx-3' y 'gy-3' al 'row' principal para el espacio --}}
    <div class="row gx-2 gy-2"> {{-- gx-3 para gap horizontal (entre columnas), gy-3 para gap vertical (entre filas apiladas) --}}
        
        {{-- Columna para el BANNER VERTICAL (izquierda) --}}
        <div class="col-lg-4 col-md-5">
            <div class="banner-vertical position-relative">
                {{-- Asegúrate de que 'banner_vertical.png' esté en public/images/banners/ --}}
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
            {{-- CAMBIO CRÍTICO AQUÍ: También añadimos 'gx-3' y 'gy-3' al 'row' de los banners horizontales --}}
            <div class="row gx-2 gy-2"> 
                
                {{-- BANNER SUPERIOR HORIZONTAL --}}
                <div class="col-12">
                    <div class="banner-horizontal position-relative"> 
                        {{-- 'mb-0' ya no es necesario si 'gy-3' se encarga del espaciado vertical --}}
                        <img src="{{ asset('images/banners/banner_verticalgrande.png') }}" class="img-fluid w-100" alt="Oferta Especial">
                        <div class="banner-content banner-content-center p-3 text-white">                           
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-shop-now">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                            {{-- Círculo de descuento (revisa si los valores de texto se deben poblar dinámicamente) --}}
                            <div class="discount-circle position-absolute top-0 end-0 me-3 mt-3">
                                <span class="d-block text-center sale-text">¡OFERTA!</span>
                                <span class="d-block text-center percent-text">20%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Carrusel para el BANNER INFERIOR HORIZONTAL --}}
                <div class="col-12 mt-2"> {{-- Añadido mt-2 para un pequeño margen si lo necesitas --}}
                    <div id="bottomBannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000"> {{-- Cambia 'data-bs-interval' si quieres otro tiempo --}}
                        <div class="carousel-inner rounded"> {{-- 'rounded' para bordes redondeados si aplica --}}
                            
                            {{-- Primer Slide Inferior (Activo) --}}
                            <div class="carousel-item active">
                                <img src="{{ asset('images/banners/banner1.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta Delivery Gratis">
                                <div class="carousel-caption d-none d-md-block text-center text-white"> {{-- Ajusta el color del texto y posición según tu imagen --}}
                                    <h5>DELIVERY GRATIS</h5>
                                    <p>En todo kekes y tartas con todo medio de pago</p>
                                    <a href="#" class="btn btn-success btn-sm">VER TODO</a>
                                </div>
                            </div>

                            {{-- Segundo Slide Inferior --}}
                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner2.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Promoción Especial">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>¡Nuevos Postres!</h5>
                                    <p>Descubre nuestra variedad de dulces.</p>
                                    <a href="#" class="btn btn-warning btn-sm">Explorar</a>
                                </div>
                            </div>

                            {{-- Tercer Slide Inferior --}}
                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner3.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>
                           {{-- cuarto Slide Inferior --}}
                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner4.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>
                             {{-- quinto Slide Inferior --}}
                            <div class="carousel-item">
                                <img src="{{ asset('images/banners/banner5.jpg.webp') }}" class="d-block w-100 img-fluid" alt="Oferta de Panadería">
                                <div class="carousel-caption d-none d-md-block text-center text-white">
                                    <h5>Pan Caliente del Día</h5>
                                    <p>Recién horneado, ¡irresistible!</p>
                                    <a href="#" class="btn btn-info btn-sm">Ver Panadería</a>
                                </div>
                            </div>
                            {{-- Puedes añadir más 'carousel-item' aquí si tienes más banners para este carrusel --}}

                        </div>

                        {{-- Opcional: Controles (flechas) para el carrusel inferior --}}
                        <button class="carousel-control-prev" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                        {{-- Opcional: Indicadores (puntos) para el carrusel inferior --}}
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                            {{-- Asegúrate de añadir un botón por cada 'carousel-item' que tengas --}}
                        </div>
                    </div>
                </div>

            </div> {{-- Fin .row gx-2s gy-2 para banners horizontales --}}
        </div> {{-- Fin .col-lg-8 --}}
    </div> {{-- Fin .row gx-3 gy-3 banners principales --}}
</div> {{-- Fin .container-fluid --}}



{{-- SECCIONES INFERIORES --}}
<div class="container mt-4"> {{-- Añadido mt-4 para separación del grupo de banners --}}
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Nuestras Categorías</h2>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-2 mb-2">
                        <div class="card h-100">
                            @if($category->image)
                                <img src="{{ asset('images/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text">{{ $category->description }}</p>
                                <a href="{{ route('productos', ['category' => $category->id]) }}" class="btn btn-primary">Ver Productos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Productos Destacados</h2>
            <div class="row">
                @foreach($featuredProducts as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            @if($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0">${{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('productos.show', $product) }}" class="btn btn-primary">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mb-5">
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

    <div class="row mb-5">
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