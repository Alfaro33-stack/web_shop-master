<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:255',
            'payment_method' => 'required|in:credit_card,paypal',
            'tipo_entrega' => 'required|in:delivery,recogo',
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        try {
            DB::beginTransaction();

            // Crear la orden
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total' => $cart->total,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_country' => $request->shipping_country,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'tipo_entrega' => $request->tipo_entrega,
            ]);

            // Crear los items de la orden
            foreach ($cart->items as $item) {
                $product = $item->product;
                
                // Verificar stock
                if ($product->stock < $item->quantity) {
                    throw new \Exception("No hay suficiente stock para {$product->name}");
                }

                // Crear el item de la orden
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);

                // Actualizar el stock
                $product->stock -= $item->quantity;
                $product->save();
            }

            // Limpiar el carrito
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            // Generar PDF de la boleta
            $user = Auth::user();
            $pdf = \PDF::loadView('boleta', [
                'user' => $user,
                'order' => $order
            ]);
            $pdfPath = storage_path('app/public/boletas/boleta_' . $order->id . '.pdf');
            if (!file_exists(storage_path('app/public/boletas'))) {
                mkdir(storage_path('app/public/boletas'), 0777, true);
            }
            $pdf->save($pdfPath);

            // Preparar mensaje de WhatsApp con enlace de descarga
            $whatsappNumber = $user->celular;
            $pdfUrl = asset('storage/boletas/boleta_' . $order->id . '.pdf');
            $mensaje = urlencode('Este es su boleta de compra, gracias por su preferencia, pronto le llegará su pedido.\nDescargue su boleta aquí: ' . $pdfUrl);
            $whatsappLink = "https://wa.me/{$whatsappNumber}?text={$mensaje}";

            // Redirigir mostrando solo un mensaje simple de éxito
            return redirect()->route('orders.index')
                ->with('success', '¡Tu pedido ha sido procesado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
} 