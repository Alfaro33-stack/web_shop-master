@extends('layouts.app')

@section('content')

{{-- BANNERS PRINCIPALES --}}
<div class="container-fluid main-banners-section mt-0 mb-4">
    {{-- CLAVE: El `row` debe ser un contenedor flexbox para que las columnas se estiren --}}
    <div class="row gx-3 gy-3 align-items-stretch">
        
        {{-- Columna para el BANNER VERTICAL (izquierda) --}}
        {{-- CLAVE: Añadido d-flex para que el div interno se estire --}}
        <div class="col-lg-3 col-md-4 col-12 d-flex">
            <div class="banner-vertical position-relative rounded shadow-sm overflow-hidden h-100 w-100"> 
                {{-- CLAVE: Añadido object-fit-cover para que la imagen cubra todo el contenedor --}}
                <img src="{{ asset('images/banners/banner_vertical.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Ahorra con Tottus">
                <div class="banner-content banner-content-left p-3">
                    {{-- Contenido de texto/botones --}}
                </div>
            </div>
        </div>

        {{-- Columna para los BANNERS HORIZONTALES (derecha) --}}
        {{-- CLAVE: Convertimos esta columna en un contenedor flexbox vertical --}}
        <div class="col-lg-9 col-md-8 col-12 d-flex flex-column"> 
            {{-- CLAVE: El `row` interno debe tener flex-grow-1 para estirarse --}}
            <div class="row gx-3 gy-3 flex-grow-1">
                
                {{-- BANNER SUPERIOR HORIZONTAL --}}
                {{-- CLAVE: Añadido d-flex flex-column para que el contenido interno se estire --}}
                <div class="col-12 d-flex flex-column">
                    {{-- CLAVE: Añadido flex-grow-1 para que este banner ocupe su parte del espacio --}}
                    <div class="banner-horizontal position-relative rounded shadow-sm overflow-hidden flex-grow-1"> 
                        {{-- La imagen ya tenía w-100, añadimos h-100 y object-fit-cover --}}
                        <img src="{{ asset('images/banners/banner_verticalgrande.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Festival de Cítricos">
                        <div class="banner-content banner-content-center p-3 text-white d-flex flex-column justify-content-center align-items-center h-100 w-100"> 
                            {{-- ... Contenido del banner horizontal (botones, texto, etc.) ... --}}
                            <a href="{{ route('productos') }}" class="btn btn-primary btn-shop-now mt-auto mb-3">OFERTAS <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                        <div class="discount-circle position-absolute top-3 end-0 m-3">
                            <span class="d-block text-center sale-text">¡OFERTA!</span>
                            <span class="d-block text-center percent-text">20%</span>
                        </div>
                    </div>
                </div>

                {{-- Carrusel para el BANNER INFERIOR HORIZONTAL --}}
                {{-- CLAVE: Añadido d-flex flex-column y flex-grow-1 --}}
                <div class="col-12 mt-2 d-flex flex-column">
                    <div id="bottomBannerCarousel" class="carousel slide rounded shadow-sm overflow-hidden flex-grow-1" data-bs-ride="carousel" data-bs-interval="4000">
                        {{-- CLAVE: Añadido h-100 para que los items ocupen toda la altura --}}
                        <div class="carousel-inner h-100">
                            {{-- CLAVE: Añadido h-100 y object-fit-cover a las imágenes dentro del carrusel --}}
                            <div class="carousel-item active h-100">
                                <img src="{{ asset('images/banners/banner1.jpg.webp') }}" class="d-block w-100 h-100 object-fit-cover" alt="Oferta Delivery Gratis">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/banners/banner2.jpg.webp') }}" class="d-block w-100 h-100 object-fit-cover" alt="Promoción Especial">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/banners/banner3.jpg.webp') }}" class="d-block w-100 h-100 object-fit-cover" alt="Oferta de Panadería">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/banners/banner4.jpg.webp') }}" class="d-block w-100 h-100 object-fit-cover" alt="Oferta de Panadería">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="{{ asset('images/banners/banner5.jpg.webp') }}" class="d-block w-100 h-100 object-fit-cover" alt="Oferta de Panadería">
                            </div>
                        </div>
                        <!-- Restaurados los controles de flecha -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        {{-- Controles del carrusel --}}
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#bottomBannerCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- Sección "Nuestras Categorías" --}}
<div class="container-fluid fruit-categories-section mt-5 mb-5">
    <h2 class="text-center mb-4">Nuestras Categorías</h2>
    {{-- El `row` padre necesita align-items-stretch para que las columnas se estiren --}}
    <div class="row gx-3 align-items-stretch">
        
        {{-- Columna para el BANNER GRANDE de frutas (izquierda) --}}
        <div class="col-lg-6 col-md-6 col-12 d-flex">
            <div class="fruit-category-banner position-relative rounded shadow-sm overflow-hidden h-100">
                {{-- CLAVE: Añadido object-fit-cover --}}
                <img src="{{ asset('images/banners/bannercuadrado_frutas.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Frutas Frescas Mejores Precios">
                <div class="banner-overlay-text text-white">
                    <h3 class="fw-bold mb-2">Frutas Frescas</h3>
                    <p class="mb-3">Mejores Precios</p>
                    @php
                        $frutasCategory = $categories->where('name', 'Frutas')->first();
                    @endphp
                    @if($frutasCategory)
                        <a href="{{ route('productos', ['category' => $frutasCategory->id]) }}" class="btn btn-primary">Ver Frutas</a>
                    @else
                        <a href="{{ route('productos') }}" class="btn btn-primary">Ver Productos</a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Columna para los ELEMENTOS de la derecha (iconos y cítricos) --}}
        {{-- CLAVE: Convertimos esta columna en un contenedor flexbox vertical --}}
        <div class="col-lg-6 col-md-6 col-12 d-flex flex-column">
            {{-- CLAVE: El `row` interno debe tener flex-grow-1 para estirarse --}}
            <div class="row g-3 flex-grow-1">
                
                {{-- Cuadrícula de iconos --}}
                {{-- CLAVE: Añadido d-flex y flex-grow-1 para que se estire --}}
                <div class="col-12 d-flex flex-column flex-grow-1">
                    <div class="small-icon-grid card shadow-sm border-0 rounded h-100 p-3">
                        {{-- Aquí va tu cuadrícula de íconos --}}
                        <div class="row g-2 justify-content-center align-items-center">
                            {{-- ... tus iconos y texto ... --}}
                            <div class="col-4 text-center">
                                <i class="fas fa-apple-alt icon-lg text-success"></i>
                                <p class="mb-0">Manzana</p>
                            </div>
                            <div class="col-4 text-center">
                                <i class="fas fa-lemon icon-lg text-warning"></i>
                                <p class="mb-0">Plátano</p>
                            </div>
                            <div class="col-4 text-center">
                                <i class="fas fa-lemon icon-lg text-info"></i>
                                <p class="mb-0">Arándanos</p>
                            </div>
                            <div class="col-4 text-center">
                                <i class="fas fa-cherry icon-lg text-danger"></i>
                                <p class="mb-0">Cerezas</p>
                            </div>
                            <div class="col-4 text-center">
                                <i class="fas fa-apple-alt icon-lg text-success"></i>
                                <p class="mb-0">Higos</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Banner de cítricos --}}
                {{-- CLAVE: Añadido d-flex y flex-grow-1 para que se estire --}}
                <div class="col-12 mt-3 d-flex flex-grow-1">
                    <div class="citrus-banner position-relative rounded shadow-sm overflow-hidden h-100 w-100">
                        {{-- CLAVE: Añadido object-fit-cover --}}
                        <img src="{{ asset('images/banners/horizontal_bannerfrutas.png') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Citrus Festivals">
                        <div class="banner-overlay-text text-white">
                            <h3 class="fw-bold mb-1">Recetas con Frutas</h3>
                            <p class="mb-3">11/07/2025</p>
                            <a href="#" class="btn btn-success">COMPRAR AHORA</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN DE PRODUCTOS DESTACADOS --}}
<div class="container-fluid productos-destacados px-4 mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Productos Destacados</h2>
            <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-inner">
                    @foreach($featuredProducts->chunk(4) as $chunkIndex => $productChunk)
                        <div class="carousel-item @if($chunkIndex == 0) active @endif">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                                @foreach($productChunk as $product)
                                    <div class="col">
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
                                                <p class="card-text text-muted mb-2">S/ {{ number_format($product->price, 2) }}</p>
                                                <div class="text-warning small mb-2">
                                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                                </div>
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-100 add-to-cart-form mt-2">
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
                        </div>
                    @endforeach
                </div>
                @if($featuredProducts->count() > 4)
                <button class="carousel-control-prev custom-carousel-arrow" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next custom-carousel-arrow" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- SECCIÓN ZONA DE DESCUENTOS VISUALES --}}
<div class="container-fluid zona-descuentos mt-5 mb-5">
    <h2 class="text-center">Grandes Descuentos</h2>
    <div class="descuentos-grid">
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuento/descuento1.jpg.webp') }}" alt="Descuento 1">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuento/descuento2.jpg.webp') }}" alt="Descuento 2">
            </a>
        </div>
        <div class="descuento-item">
            <a href="#">
                <img src="{{ asset('images/descuento/descuento3.jpg.webp') }}" alt="Descuento 3">
            </a>
        </div>


    </div>
</div>

@if(!isset($__cart_toast_included))
    @php($__cart_toast_included = true)
    <div id="cart-toast" style="display:none; position:fixed; left:50%; transform:translateX(-50%); bottom:40px; z-index:9999; min-width:320px; background:#28a745; color:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:18px 32px; font-size:1.25em; font-weight:bold; text-align:center;">
        Se agregó al carrito.
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
                showCartToast();
            })
            .catch(() => {
                showCartToast('No se pudo agregar el producto', true);
            });
        });
    });
    function showCartToast(msg = 'Se agregó al carrito.', error = false) {
        const toast = document.getElementById('cart-toast');
        toast.textContent = msg;
        toast.style.background = error ? '#dc3545' : '#28a745';
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
    </script>
    @endpush
@endif

@push('styles')
<style>
.custom-carousel-arrow {
    width: 48px;
    height: 48px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.18) !important;
    border-radius: 50%;
    border: none;
    z-index: 2;
}
.custom-carousel-arrow .carousel-control-prev-icon,
.custom-carousel-arrow .carousel-control-next-icon {
    filter: invert(1) drop-shadow(0 0 2px #fff);
    width: 2rem;
    height: 2rem;
}
.carousel-item {
  transition: transform 1.8s cubic-bezier(0.4, 0, 0.2, 1) !important;
}
</style>
@endpush

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