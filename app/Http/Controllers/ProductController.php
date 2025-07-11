<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('active', true);
        $selectedCategory = null;

        // Búsqueda por nombre, descripción, etc. (tiene prioridad)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ;
            });
        } else if ($request->has('category')) {
            // Solo filtrar por categoría si no hay búsqueda
            $query->where('category_id', $request->category);
            $selectedCategory = Category::find($request->category);
        }

        // Ordenar por precio
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(20); // 4 columnas x 5 filas
        $categories = Category::where('active', true)->get();

        // Obtener el carrito actual del usuario (si está autenticado)
        $cart = null;
        if (auth()->check()) {
            $cart = auth()->user()->cart()->with('items')->first();
        }

        // Si es AJAX, retorna solo la grilla de productos
        if ($request->ajax() || $request->ajax == 1) {
            return view('products._list', compact('products', 'cart'))->render();
        }

        return view('products.index', compact('products', 'categories', 'selectedCategory', 'cart'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Obtener productos relacionados de la misma categoría
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('active', true)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
} 