@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Imagen del Producto -->
        <div class="col-md-6 mb-4">
            <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" alt="{{ $product->name }}" class="img-fluid rounded">
        </div>

        <!-- Detalles del Producto -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <p class="text-muted mb-4">{{ $product->description }}</p>
            
            <div class="d-flex align-items-center mb-4">
                <h2 class="text-primary mb-0">${{ number_format($product->price, 2) }}</h2>
                @if($product->stock > 0)
                    <span class="badge bg-success ms-3">En Stock</span>
                @else
                    <span class="badge bg-danger ms-3">Agotado</span>
                @endif
            </div>

            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group mb-3" style="max-width: 200px;">
                    <button type="button" class="btn btn-outline-secondary" onclick="decrementQuantity()">-</button>
                    <input type="number" name="quantity" id="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}" readonly>
                    <button type="button" class="btn btn-outline-secondary" onclick="incrementQuantity()">+</button>
                </div>
                <button type="submit" class="btn btn-primary" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fas fa-shopping-cart me-2"></i>Agregar al Carrito
                </button>
            </form>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Características</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Calidad garantizada</li>
                        <li><i class="fas fa-truck text-primary me-2"></i>Envío rápido</li>
                        <li><i class="fas fa-shield-alt text-info me-2"></i>Garantía de satisfacción</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos Relacionados -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4">Productos Relacionados</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="{{ $relatedProduct->image ? asset('images/products/' . basename($relatedProduct->image)) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($relatedProduct->description, 100) }}</p>
                            <p class="card-text text-primary fw-bold">${{ number_format($relatedProduct->price, 2) }}</p>
                            <a href="{{ route('productos.show', $relatedProduct->id) }}" class="btn btn-outline-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        const currentValue = parseInt(input.value);
        if (currentValue < max) {
            input.value = currentValue + 1;
        }
    }

    function decrementQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }
</script>
@endpush
@endsection 