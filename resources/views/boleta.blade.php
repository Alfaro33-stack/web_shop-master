<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Compra</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #222; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 18px; border-bottom: 2px solid #28a745; padding-bottom: 10px; }
        .header img { max-height: 60px; margin-bottom: 8px; }
        .header h2 { margin: 0; color: #28a745; font-size: 1.7em; }
        .header .subtitle { font-size: 1.1em; color: #555; margin-bottom: 2px; }
        .info, .items { width: 100%; margin-bottom: 15px; }
        .info td { padding: 2px 4px; font-size: 1em; }
        .info strong { color: #28a745; }
        .items th, .items td { border: 1px solid #c8e6c9; padding: 7px 10px; text-align: left; }
        .items th { background: #e8f5e9; color: #222; font-size: 1em; }
        .items tr:nth-child(even) { background: #f9f9f9; }
        .total-row td { font-weight: bold; font-size: 1.1em; background: #e8f5e9; color: #28a745; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #888; border-top: 1px solid #e0e0e0; padding-top: 10px; }
        .contacto { margin-top: 8px; font-size: 0.98em; color: #444; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('images/logo/tottus_logo1.png')))
            <img src="{{ public_path('images/logo/tottus_logo1.png') }}" alt="Tottus Logo">
        @endif
        <h2>"Alimentos Frescos"</h2>
        <div class="subtitle">Falabella.com S.A.C.</div>
        <div>Av. Paseo de la República 3220, San Isidro, Perú</div>
        <div>RUC: 20508565934</div>
        <div class="contacto">Tel: (01) 800-1234 &nbsp;|&nbsp; Email: contacto@tottus.com</div>
    </div>
    <table class="info">
        <tr>
            <td><strong>Cliente:</strong> {{ $user->name }}</td>
            <td><strong>Celular:</strong> {{ $user->celular }}</td>
        </tr>
        <tr>
            <td><strong>Dirección de envío:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }}</td>
            <td><strong>Código Postal:</strong> {{ $order->shipping_zipcode }}</td>
        </tr>
        <tr>
            <td><strong>Método de Pago:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
            <td><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>N° Pedido:</strong> #{{ $order->id }}</td>
        </tr>
    </table>
    <table class="items" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>S/ {{ number_format($item->product->price, 2) }}</td>
                    <td>S/ {{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total</td>
                <td>S/ {{ number_format($order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="footer">
        Este es su boleta de compra, gracias por su preferencia, pronto le llegará su pedido.<br>
        <strong>TOTTUS </strong>
        <strong>"Alimentos Frescos"</strong>

    </div>
    <!-- Toast flotante para agregar al carrito -->
    <div id="cart-toast" style="display:none; position:fixed; left:50%; transform:translateX(-50%); bottom:40px; z-index:9999; min-width:320px; background:#28a745; color:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:18px 32px; font-size:1.25em; font-weight:bold; text-align:center;">
        Se agregó al carrito.
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form.add-to-cart-form').forEach(form => {
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
    });
    function showCartToast(msg = 'Se agregó al carrito.', error = false) {
        const toast = document.getElementById('cart-toast');
        toast.textContent = msg;
        toast.style.background = error ? '#dc3545' : '#28a745';
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
    </script>
</body>
</html> 