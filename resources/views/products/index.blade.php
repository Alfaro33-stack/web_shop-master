@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Nuestros Productos</h1>

    <div class="row">
        <!-- Filtros -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Filtros</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('productos') }}" method="GET">
                        <!-- Filtro de Categorías -->
                        <div class="mb-3">
                            <label class="form-label">Categorías</label>
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ordenar por -->
                        <div class="mb-3">
                            <label class="form-label">Ordenar por</label>
                            <select name="sort" class="form-select" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Más recientes</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Lista de Productos -->
        <div class="col-md-9">
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
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text"><strong>${{ number_format($product->price, 2) }}</strong></p>
                                    <a href="{{ route('productos.show', $product->id) }}" class="btn btn-primary">Ver Detalles</a>
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