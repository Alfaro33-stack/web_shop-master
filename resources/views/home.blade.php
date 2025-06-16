@extends('layouts.app')

@section('content')
{{-- BANNERS PRINCIPALES (1 Vertical, 2 Horizontales) --}}
<div class="container-fluid px-0"> {{-- Usamos container-fluid y px-0 para que los banners se extiendan por todo el ancho --}}
    <div class="row g-0"> {{-- g-0 para eliminar los gutters/espacio entre columnas --}}
        {{-- Columna para el banner vertical (izquierda) --}}
        <div class="col-lg-4 col-md-5">
            <div class="banner-vertical position-relative">
                <img src="{{ asset('images/banners/banner_vertical.png') }}" class="img-fluid w-100" alt="Banner Cebolla">
                <div class="banner-content banner-content-left p-3">
                    <p class="small-text">ONION FAMILY SAY7</p>
                    <h2 class="title-text">Hello</h2>
                    <p class="bottom-text">TO MASTERCHEF!</p>
                </div>
            </div>
        </div>

        {{-- Columna para los dos banners horizontales (derecha) --}}
        <div class="col-lg-8 col-md-7">
            <div class="row g-0"> {{-- g-0 para eliminar los gutters entre los banners horizontales --}}
                <div class="col-12">
                    <div class="banner-horizontal position-relative mb-0"> {{-- mb-0 para pegar al banner de abajo --}}
                        <img src="{{ asset('images/banner_plum.jpg') }}" class="img-fluid w-100" alt="Banner Ciruelas">
                        <div class="banner-content banner-content-center p-3 text-white">
                            <h3 class="title-text">Strawberry</h3>
                            <p class="slogan-text">Simply Natural & Tasty</p>
                            <a href="#" class="btn btn-primary btn-shop-now">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                            <div class="discount-circle position-absolute top-0 end-0 me-3 mt-3">
                                <span class="d-block text-center sale-text">SALE</span>
                                <span class="d-block text-center percent-text">-25%</span>
                            </div>
                            <div class="price-circle position-absolute bottom-0 end-0 me-3 mb-3">
                                <span class="d-block text-center price-text">$36</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="banner-horizontal-thin position-relative">
                        <img src="{{ asset('images/banner_vegetables.jpg') }}" class="img-fluid w-100" alt="Banner Verduras">
                        <div class="banner-content banner-content-right text-white p-3">
                            <h3 class="title-text">TOTTUS</h3>
                            <p class="slogan-text">Alimentos Frescos</p>
                            <p class="description-text">Discover our amazing products and special offers</p>
                            <a href="#" class="btn btn-primary btn-shop-now">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4"> {{-- Este es tu div container original, le añadimos mt-4 para separación --}}
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4">TOTTUS</h1>
            <h1 class="display-4">Alimentos Frescos</h1>
            <p class="lead">Discover our amazing products and special offers</p>
            <a href="{{ route('productos') }}" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>
{{-- ... el resto de tu home.blade.php sigue aquí (Categories, Featured Products, etc.) ... --}}

    <!-- Categories Section -->
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

    <!-- Featured Products Section -->
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

    <!-- Special Offers Section -->
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

    <!-- Newsletter Section -->
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
