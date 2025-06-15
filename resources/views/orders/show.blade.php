@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detalles del Pedido #{{ $order->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Estado del Pedido</h6>
                            <p class="mb-0">
                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'info') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Estado del Pago</h6>
                            <p class="mb-0">
                                <span class="badge bg-{{ $order->payment_status === 'pending' ? 'warning' : ($order->payment_status === 'paid' ? 'success' : 'danger') }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <h6>Productos</h6>
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                <small class="text-muted">Cantidad: {{ $item->quantity }}</small>
                            </div>
                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h6>Dirección de Envío</h6>
                            <p class="mb-0">
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zipcode }}<br>
                                {{ $order->shipping_country }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Método de Pago</h6>
                            <p class="mb-0">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Resumen</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Envío</span>
                        <span>Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>${{ number_format($order->total, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 