@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if($user->isAdmin())
        <h2 class="mb-4" style="color: #28a745;">Dashboard Administrativo</h2>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Usuarios Registrados (últimos 10)</div>
                    <div class="card-body p-2">
                        <table class="table table-sm table-borderless mb-0">
                            <thead>
                                <tr><th>Nombre</th><th>Email</th><th>Fecha</th></tr>
                            </thead>
                            <tbody>
                                @foreach($latestUsers as $u)
                                    <tr>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Crecimiento de Usuarios (14 días)</div>
                    <div class="card-body p-2">
                        <canvas id="usersByDayChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Ventas del Día</div>
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><strong>Pedidos:</strong> {{ $totalOrdersToday }}</div>
                            <div><strong>Total:</strong> S/ {{ number_format($totalSalesToday, 2) }}</div>
                        </div>
                        <canvas id="salesByHourChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">Top 10 Productos Más Vendidos</div>
                    <div class="card-body p-2">
                        <table class="table table-sm table-borderless mb-0">
                            <thead>
                                <tr><th>Producto</th><th>Cant.</th><th>Total S/</th></tr>
                            </thead>
                            <tbody>
                                @foreach($topProducts as $item)
                                    <tr>
                                        <td>{{ $item->product ? $item->product->name : 'Producto eliminado' }}</td>
                                        <td>{{ $item->total_quantity }}</td>
                                        <td>{{ number_format($item->total_sales, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <canvas id="topProductsChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Colores verdes del sitio
            const mainGreen = '#28a745';
            const lightGreen = '#81c784';

            // Usuarios por día
            const usersByDayLabels = {!! json_encode(array_keys($usersByDay->toArray())) !!};
            const usersByDayData = {!! json_encode(array_values($usersByDay->toArray())) !!};
            new Chart(document.getElementById('usersByDayChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: usersByDayLabels,
                    datasets: [{
                        label: 'Nuevos usuarios',
                        data: usersByDayData,
                        borderColor: mainGreen,
                        backgroundColor: lightGreen,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Ventas por hora
            const salesByHourLabels = {!! json_encode(array_map(fn($h) => $h.':00', array_keys($salesByHour->toArray()))) !!};
            const salesByHourData = {!! json_encode(array_values($salesByHour->toArray())) !!};
            new Chart(document.getElementById('salesByHourChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: salesByHourLabels,
                    datasets: [{
                        label: 'Ventas S/',
                        data: salesByHourData,
                        backgroundColor: mainGreen
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Top productos
            const topProductsLabels = {!! json_encode($topProducts->map(fn($i) => $i->product ? $i->product->name : 'Eliminado')->toArray()) !!};
            const topProductsData = {!! json_encode($topProducts->map(fn($i) => $i->total_quantity)->toArray()) !!};
            new Chart(document.getElementById('topProductsChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: topProductsLabels,
                    datasets: [{
                        label: 'Cantidad vendida',
                        data: topProductsData,
                        backgroundColor: mainGreen
                    }]
                },
                options: {
                    indexAxis: 'y',
                    plugins: { legend: { display: false } },
                    scales: { x: { beginAtZero: true } }
                }
            });
        </script>
    @else
        <h2 class="mb-4" style="color: #28a745;">Mi Perfil</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">Modificar Datos</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('perfil.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                            </div>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">Historial de Compras</div>
                    <div class="card-body">
                        @if($orders->isEmpty())
                            <p class="text-muted">Aquí aparecerán tus compras realizadas.</p>
                        @else
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Pedido</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                            <td>#{{ $order->id }}</td>
                                            <td>S/ {{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'completed' ? 'success' : 'info') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ asset('storage/boletas/boleta_' . $order->id . '.pdf') }}" class="btn btn-outline-success btn-sm" target="_blank">Descargar boleta</a>
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary ms-1">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection 