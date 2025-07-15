<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController; // No usada, puedes eliminarla
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registras las rutas web para tu aplicación.
|
*/

// ===================================
// RUTAS PÚBLICAS
// ===================================

// Ruta de la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para la página de contacto
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');

// Rutas de productos
Route::get('/productos', [ProductController::class, 'index'])->name('productos');
Route::get('/productos/{product}', [ProductController::class, 'show'])->name('productos.show');

// Endpoint para autocompletado y sugerencias inteligentes de productos
Route::get('/productos-autocomplete', [ProductController::class, 'autocomplete'])->name('productos.autocomplete');

// Rutas de categorías
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias');
Route::get('/categorias/{category}', [CategoryController::class, 'show'])->name('categorias.show');


// ===================================
// RUTAS DE AUTENTICACIÓN
// ===================================
// Auth::routes() incluye rutas para login, registro, reset de contraseña, etc.
Auth::routes(); // Hay dos llamadas a Auth::routes(), solo necesitas una.


// ===================================
// RUTAS DEL CARRITO
// ===================================
// Agrupa las rutas del carrito en un prefijo para organizarlas
Route::prefix('carrito')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->middleware('auth')->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::delete('/remove/{product}', [CartController::class, 'remove'])->middleware('auth')->name('remove');
    Route::patch('/update/{product}', [CartController::class, 'update'])->middleware('auth')->name('update');
    Route::delete('/clear', [CartController::class, 'clear'])->middleware('auth')->name('clear');
});


// ===================================
// RUTAS PROTEGIDAS (requieren autenticación)
// ===================================
Route::middleware(['auth'])->group(function () {
    // Perfil de usuario
    Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [HomeController::class, 'updatePerfil'])->name('perfil.update');

    // Rutas de órdenes
    // Usa un prefijo y grupo para organizarlas
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });
});


// ===================================
// RUTAS PARA ADMINISTRADORES (requieren autenticación y rol de admin)
// ===================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'admin'])->name('index');
    // Puedes añadir más rutas de administración aquí, por ejemplo:
    // Route::resource('products', ProductController::class);
});