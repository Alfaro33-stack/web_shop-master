@extends('layouts.app')

@section('content')
<!-- Banner superior -->
<div class="shop-banner position-relative mb-4" style="background: url('{{ isset($selectedCategory) && $selectedCategory && $selectedCategory->image ? asset('images/' . $selectedCategory->image) : asset('images/banners/banner_carrusell-pica.png') }}') center/cover no-repeat; min-height: 220px;">
    <div class="container h-100 d-flex flex-column justify-content-center">
        <h1 class="text-white fw-bold display-5 mb-2" style="text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
            {{ isset($selectedCategory) && $selectedCategory ? $selectedCategory->name : 'Shop' }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                @if(isset($selectedCategory) && $selectedCategory)
                    <li class="breadcrumb-item"><a href="{{ route('productos') }}" class="text-white-50">Shop</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $selectedCategory->name }}</li>
                @else
                    <li class="breadcrumb-item active text-white" aria-current="page">Shop</li>
                @endif
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Panel lateral de filtros -->
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white fw-bold">Filter By Price</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="range" class="form-range" min="0" max="100" value="100" id="priceRange">
                        <div class="d-flex justify-content-between small">
                            <span>S/0</span>
                            <span>S/100</span>
                        </div>
                    </div>
                    <button class="btn btn-success w-100">FILTER</button>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white fw-bold">Product Categories</div>
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item d-flex align-items-center">
                            <span class="me-2"><i class="fas fa-apple-alt text-success"></i></span>
                            <a href="{{ route('productos', ['category' => $category->id]) }}" class="text-dark text-decoration-none flex-grow-1">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white fw-bold">Search</div>
                <div class="card-body p-2">
                    <form action="{{ route('productos') }}" method="GET">
                        <input type="text" name="search" class="form-control mb-2" placeholder="Search Here..." value="{{ request('search') }}">
                        <button class="btn btn-success w-100" type="submit"><i class="fas fa-search"></i> Search</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Zona de productos -->
        <div class="col-lg-9">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="small text-muted mb-2 mb-lg-0">
                    Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route('productos') }}" method="GET" class="d-flex align-items-center">
                        <select name="sort" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Default sorting</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </form>
                    <div class="btn-group ms-2" role="group">
                        <button type="button" class="btn btn-outline-success btn-sm active"><i class="fas fa-th"></i></button>
                        <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-list"></i></button>
                    </div>
                </div>
            </div>

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
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative bg-light" style="height: 220px; display: flex; align-items: center; justify-content: center;">
                                    @if(rand(0,4) == 0)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Sale!</span>
                                    @endif
                                    <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" class="img-fluid" alt="{{ $product->name }}" style="max-height: 180px; object-fit: contain;">
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
                                    <a href="{{ route('productos.show', $product->id) }}" class="btn btn-outline-success mt-auto">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 