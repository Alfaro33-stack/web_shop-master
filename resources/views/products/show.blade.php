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
        <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">
            <div style="width:100%; max-width:420px; height:420px; background:#fff; display:flex; align-items:center; justify-content:center; border-radius:16px; box-shadow:0 2px 8px rgba(0,0,0,0.04); cursor:pointer; overflow:hidden;" data-bs-toggle="modal" data-bs-target="#productImageModal">
                <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" alt="{{ $product->name }}" style="max-width:100%; max-height:100%; object-fit:cover;" class="product-detail-img-zoom">
            </div>
        </div>

        <!-- Modal para ampliar imagen -->
        <div class="modal fade" id="productImageModal" tabindex="-1" aria-labelledby="productImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body d-flex justify-content-center align-items-center p-0">
                        <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" alt="{{ $product->name }}" style="max-width:90vw; max-height:80vh; object-fit:cover; box-shadow:0 2px 16px rgba(0,0,0,0.2); background:#fff; border-radius:16px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles del Producto -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <p class="product-desc-green text-muted mb-4">{{ $product->description }}</p>
            
            <div class="d-flex align-items-center mb-4">
                <h2 class="product-price-green mb-0">S/ {{ number_format($product->price, 2) }}</h2>
                @if($product->stock > 0)
                    <span class="badge bg-success ms-3">En Stock</span>
                @else
                    <span class="badge bg-danger ms-3">Agotado</span>
                @endif
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4 add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-green" {{ $product->stock <= 0 ? 'disabled' : '' }}>
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
                    <div class="card h-100 related-product-card">
                        <img src="{{ $relatedProduct->image ? asset('images/products/' . basename($relatedProduct->image)) : asset('images/no-image.png') }}" class="card-img-top related-img-zoom" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <p class="card-text related-desc-green">{{ Str::limit($relatedProduct->description, 100) }}</p>
                            <p class="card-text related-price-green">S/ {{ number_format($relatedProduct->price, 2) }}</p>
                            <a href="{{ route('productos.show', $relatedProduct->id) }}" class="btn btn-green">Ver Detalles</a>
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