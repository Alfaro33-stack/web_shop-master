@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4">Welcome to Our Store</h1>
            <p class="lead">Discover our amazing products and special offers</p>
            <a href="{{ route('productos') }}" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>

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
