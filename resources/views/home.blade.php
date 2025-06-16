@extends('layouts.app')

@section('content')
{{-- BANNERS PRINCIPALES --}}
<div class="container-fluid px-0"> {{-- Usamos container-fluid y px-0 para que los banners se extiendan por todo el ancho --}}
    <div class="row g-0"> {{-- g-0 para eliminar los gutters/espacio entre columnas --}}
        
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

        {{-- Columna para los dos BANNERS HORIZONTALES (derecha) --}}
        <div class="col-lg-8 col-md-7">
            <div class="row g-0"> {{-- g-0 para eliminar los gutters entre los banners horizontales --}}
                
                {{-- BANNER SUPERIOR HORIZONTAL --}}
                <div class="col-12">
                    <div class="banner-horizontal position-relative mb-0">
                        {{-- Asegúrate de que 'banner_verticalgrande.png' esté en public/images/banners/ --}}
                        {{-- (Revisa si el nombre 'banner_verticalgrande.png' es el correcto para un banner horizontal) --}}
                        <img src="{{ asset('images/banners/banner_verticalgrande.png') }}" class="img-fluid w-100" alt="Oferta Especial">
                        <div class="banner-content banner-content-center p-3 text-white">
                            <h3 class="title-text">DELIVERY GRATIS</h3>
                            <p class="slogan-text">con todo medio de pago</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-shop-now">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                            {{-- Círculo de descuento (revisa si los valores de texto se deben poblar dinámicamente) --}}
                            <div class="discount-circle position-absolute top-0 end-0 me-3 mt-3">
                                <span class="d-block text-center sale-text">¡OFERTA!</span>
                                <span class="d-block text-center percent-text">30%</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BANNER INFERIOR HORIZONTAL (EL QUE TENÍA EL FONDO BLANCO SIN TEXTO Y SIN IMAGEN VISIBLE) --}}
                <div class="col-12">
                    <div class="banner-horizontal-thin position-relative">
                        {{-- ¡Asegúrate de que 'banner2.jpg.webp' esté en public/images/banners/ --}}
                        <img src="{{ asset('images/banners/banner2.jpg.webp') }}" class="img-fluid w-100" alt="Banner Verduras">
                        
                    </div>
                </div>

            </div> {{-- Fin .row g-0 para banners horizontales --}}
        </div> {{-- Fin .col-lg-8 --}}
    </div> {{-- Fin .row g-0 banners principales --}}
</div> {{-- Fin .container-fluid --}}

{{--
    **IMPORTANTE:**
    ELIMINA DEFINITIVAMENTE EL SIGUIENTE BLOQUE SI ES EL QUE CAUSABA LA DUPLICIDAD DE TEXTO
    Y APARECÍA FUERA DE LOS BANNERS PRINCIPALES.
    (Basado en imágenes anteriores como image_e78415.png)
--}}
{{--
<div class="container mt-4">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4">TOTTUS</h1>
            <h1 class="display-4">Alimentos Frescos</h1>
            <p class="lead">Discover our amazing products and special offers</p>
            <a href="{{ route('productos') }}" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>
</div>
--}}

{{-- SECCIONES INFERIORES --}}
<div class="container mt-4"> {{-- Añadido mt-4 para separación del grupo de banners --}}
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Nuestras Categorías</h2>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
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
