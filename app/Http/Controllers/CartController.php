<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        if (Auth::check()) {
            // Usuario logueado: carrito en base de datos
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItem = $cart->items()->where('product_id', $product->id)->first();
            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $request->quantity;
                if ($product->stock < $newQuantity) {
                    return back()->with('error', 'No hay suficiente stock disponible.');
                }
                $cartItem->quantity = $newQuantity;
                $cartItem->price = $product->price;
                $cartItem->subtotal = $product->price * $newQuantity;
                $cartItem->save();
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $request->quantity
                ]);
            }
            $cart->updateTotal();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
        } else {
            // Usuario no logueado: carrito en sesión
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $newQuantity = $cart[$product->id]['quantity'] + $request->quantity;
                if ($product->stock < $newQuantity) {
                    return back()->with('error', 'No hay suficiente stock disponible.');
                }
                $cart[$product->id]['quantity'] = $newQuantity;
                $cart[$product->id]['subtotal'] = $product->price * $newQuantity;
            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'subtotal' => $product->price * $request->quantity,
                    'image' => $product->image ? asset('images/products/' . basename($product->image)) : asset('images/no-image.png'),
                ];
            }
            session(['cart' => $cart]);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true]);
            }
            return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);
        
        if ($cartItem->cart->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para modificar este carrito.');
        }

        if ($cartItem->product->stock < $request->quantity) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->subtotal = $cartItem->price * $request->quantity;
        $cartItem->save();

        $cartItem->cart->updateTotal();

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        
        if ($cartItem->cart->user_id !== Auth::id()) {
            return back()->with('error', 'No tienes permiso para modificar este carrito.');
        }

        $cart = $cartItem->cart;
        $cartItem->delete();
        $cart->updateTotal();

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if ($cart) {
            $cart->items()->delete();
            $cart->updateTotal();
        }

        return back()->with('success', 'Carrito vaciado.');
    }
} 