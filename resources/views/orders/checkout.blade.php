@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Finalizar Compra</h1>

    <div class="row">
        <!-- Resumen del Pedido -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Resumen del Pedido</h5>
                </div>
                <div class="card-body">
                    @foreach($cart->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">Cantidad: {{ $item->quantity }}</small>
                            </div>
                            <span>S/ {{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5>S/ {{ number_format($cart->total, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Checkout -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información de Envío</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shipping_address" class="form-label">Dirección</label>
                                <input type="text" class="form-control @error('shipping_address') is-invalid @enderror" 
                                    id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required>
                                @error('shipping_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="shipping_city" class="form-label">Ciudad</label>
                                <input type="text" class="form-control @error('shipping_city') is-invalid @enderror" 
                                    id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required>
                                @error('shipping_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="shipping_state" class="form-label">Estado/Provincia</label>
                                <input type="text" class="form-control @error('shipping_state') is-invalid @enderror" 
                                    id="shipping_state" name="shipping_state" value="{{ old('shipping_state') }}" required>
                                @error('shipping_state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="shipping_zipcode" class="form-label">Código Postal</label>
                                <input type="text" class="form-control @error('shipping_zipcode') is-invalid @enderror" 
                                    id="shipping_zipcode" name="shipping_zipcode" value="{{ old('shipping_zipcode') }}" required>
                                @error('shipping_zipcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_country" class="form-label">País</label>
                            <input type="text" class="form-control @error('shipping_country') is-invalid @enderror" 
                                id="shipping_country" name="shipping_country" value="{{ old('shipping_country') }}" required>
                            @error('shipping_country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipo_entrega" class="form-label">Tipo de entrega</label>
                            <select class="form-select" id="tipo_entrega" name="tipo_entrega" required>
                                <option value="delivery" selected>Delivery</option>
                                <option value="recogo">Recogo en tienda</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Método de Pago</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                                <label class="form-check-label" for="credit_card">
                                    Tarjeta de Crédito
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                <label class="form-check-label" for="paypal">
                                    PayPal
                                </label>
                            </div>
                            @error('payment_method')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Finalizar compra</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 