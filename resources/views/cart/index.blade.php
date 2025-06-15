@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($cart && $cart->items->isNotEmpty())
        <div class="row">
            <!-- Lista de Productos -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach($cart->items as $item)
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <img src="{{ asset('images/' . $item->product->image) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $item->product->name }}">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">{{ $item->product->name }}</h5>
                                    <p class="text-muted mb-0">Precio unitario: ${{ number_format($item->price, 2) }}</p>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decrementQuantity(this)">-</button>
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock }}"
                                                   class="form-control form-control-sm text-center"
                                                   onchange="this.form.submit()">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="incrementQuantity(this)">+</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="mb-1"><strong>${{ number_format($item->subtotal, 2) }}</strong></p>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('productos') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Seguir Comprando
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash"></i> Vaciar Carrito
                        </button>
                    </form>
                </div>
            </div>

            <!-- Resumen del Pedido -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Resumen del Pedido</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>${{ number_format($cart->total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío</span>
                            <span>Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>${{ number_format($cart->total, 2) }}</strong>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('orders.checkout') }}" class="btn btn-primary">
                                Proceder al Pago
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-shopping-cart fa-5x text-muted"></i>
            </div>
            <h3 class="mb-3">Tu carrito está vacío</h3>
            <p class="text-muted mb-4">Agrega algunos productos a tu carrito para comenzar a comprar.</p>
            <a href="{{ route('productos') }}" class="btn btn-primary">
                Ver Productos
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function incrementQuantity(button) {
        const input = button.parentElement.querySelector('input');
        const max = parseInt(input.getAttribute('max'));
        const value = parseInt(input.value);
        if (value < max) {
            input.value = value + 1;
            input.form.submit();
        }
    }

    function decrementQuantity(button) {
        const input = button.parentElement.querySelector('input');
        const value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
            input.form.submit();
        }
    }
</script>
@endpush
@endsection 