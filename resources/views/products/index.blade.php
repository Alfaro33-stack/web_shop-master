@extends('layouts.app')

@section('content')
@if(empty(request('search')) && count(request()->except(['page','sort','category'])) == 0)
<!-- Banner superior -->
<div class="shop-banner position-relative mb-4" style="background: url('{{ isset(
    $selectedCategory) && $selectedCategory && $selectedCategory->image ? asset('images/' . $selectedCategory->image) : asset('images/banners/banner_carrusell-pica.png') }}') center/cover no-repeat; min-height: 450px;">
    <div class="container h-100 d-flex flex-column justify-content-center">
        <h1 class="text-white fw-bold display-5 mb-2" style="text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
            {{ isset($selectedCategory) && $selectedCategory ? $selectedCategory->name : '' }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                @if(isset($selectedCategory) && $selectedCategory)
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $selectedCategory->name }}</li>
                @endif
            </ol>
        </nav>
    </div>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="small text-muted mb-2 mb-lg-0">
                    Mostrando {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} de {{ $products->total() }} resultados
                </div>
                <form action="{{ route('productos') }}" method="GET" class="d-flex align-items-center">
                    <select name="sort" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Ordenar por defecto</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                    </select>
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                </form>
            </div>

            <div id="products-list">
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-box-open fa-5x text-muted"></i>
                    </div>
                    <h3 class="mb-3">No se encontraron productos</h3>
                    <p class="text-muted mb-4">Lo sentimos, no hay productos disponibles en esta categoría en este momento.</p>
                    <a href="{{ route('productos') }}" class="btn btn-primary">Ver todos los productos</a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative" style="height: 260px; display: flex; align-items: center; justify-content: center; background: #fff; overflow: hidden;">
                                    @if(rand(0,4) == 0)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Sale!</span>
                                    @endif
                                    <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" class="img-fluid product-zoom-img" alt="{{ $product->name }}" style="max-height: 240px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-1">{{ $product->name }}</h5>
                                    <div class="mb-2">
                                        <span class="fw-bold text-success" style="font-size:1.2em;">S/ {{ number_format($product->price, 2) }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-warning">
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="fas fa-star{{ $i < rand(3,5) ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-100 mt-auto add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center" title="Agregar al carrito">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            Agregar al carrito
                                            <span class="fw-bold text-white ms-2" style="font-size:1.2em;">+</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            </div>
            {{-- Paginación moderna y funcional: mantiene filtros y categoría --}}
            @if ($products->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {!! $products->appends(request()->query())->links() !!}
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.product-card img {
  animation: zoomInOut 3s ease-in-out infinite;
}

@keyframes zoomInOut {
  0%, 100% { transform: scale(1);}
  50% { transform: scale(1.08);}
}

.product-zoom-img {
  animation: zoomInOut 3s ease-in-out infinite;
  transition: transform 0.3s;
  will-change: transform;
}

@keyframes zoomInOut {
  0%, 100% { transform: scale(1);}
  50% { transform: scale(1.08);}
}
</style>

{{-- Toast de éxito --}}
<div id="cart-toast" style="display:none; position:fixed; bottom:32px; right:32px; z-index:9999; min-width:260px; background:#28a745; color:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:18px 28px; font-size:1.1em; align-items:center; gap:10px;">
    <i class="fas fa-check-circle me-2" style="font-size:1.4em;"></i>
    <span id="cart-toast-msg">Producto agregado al carrito</span>
</div>

@push('scripts')
<script>
document.querySelectorAll('.add-to-cart-form').forEach(form => {
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
            showCartToast('Producto agregado al carrito');
        })
        .catch(() => {
            showCartToast('No se pudo agregar el producto', true);
        });
    });
});

function showCartToast(msg, error = false) {
    const toast = document.getElementById('cart-toast');
    const msgSpan = document.getElementById('cart-toast-msg');
    toast.style.background = error ? '#dc3545' : '#28a745';
    msgSpan.textContent = msg;
    toast.style.display = 'flex';
    setTimeout(() => { toast.style.display = 'none'; }, 2200);
}
</script>
@endpush
@endsection 