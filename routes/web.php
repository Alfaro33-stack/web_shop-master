<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de productos
Route::get('/productos', [ProductController::class, 'index'])->name('productos');
Route::get('/productos/{product}', [ProductController::class, 'show'])->name('productos.show');

// Rutas de categorías
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias');
Route::get('/categorias/{category}', [CategoryController::class, 'show'])->name('categorias.show');

//rutas
Auth::routes();

// Rutas del carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/carrito/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/carrito/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/clear', [CartController::class, 'clear'])->name('cart.clear');

// Rutas de autenticación (generadas automáticamente por Auth::routes())
Auth::routes();

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    // Perfil de usuario
    Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
    
    // Rutas del carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Rutas de órdenes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Rutas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
    // Aquí irían más rutas de administración
});
