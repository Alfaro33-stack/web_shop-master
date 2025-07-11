@if(isset($products) && $products->count())
<div class="row g-4">
    @foreach($products as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 shadow-sm">
                <div class="position-relative" style="height: 260px; display: flex; align-items: center; justify-content: center; background: #fff;">
                    @if(rand(0,4) == 0)
                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Sale!</span>
                    @endif
                    <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" class="img-fluid" alt="{{ $product->name }}" style="max-height: 240px; width: 100%; object-fit: cover;">
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
<div class="d-flex justify-content-center mt-4">
    {!! $products->appends(request()->query())->links() !!}
</div>
@else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-box-open fa-5x text-muted"></i>
        </div>
        <h3 class="mb-3">No se encontraron productos</h3>
        <p class="text-muted mb-4">Lo sentimos, no hay productos disponibles en esta categoría en este momento.</p>
        <a href="{{ route('productos') }}" class="btn btn-primary">Ver todos los productos</a>
    </div>
@endif 