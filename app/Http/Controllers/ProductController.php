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

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        if (!$term || strlen($term) < 2) {
            return response()->json([]);
        }

        // Buscar coincidencias exactas o parciales
        $products = Product::where('active', true)
            ->where(function($q) use ($term) {
                $q->where('name', 'like', "%$term%")
                  ->orWhere('description', 'like', "%$term%")
                  ;
            })
            ->limit(8)
            ->get(['id', 'name']);

        // Si hay resultados, devolverlos
        if ($products->count() > 0) {
            return response()->json($products);
        }

        // Si no hay resultados, buscar sugerencias por similitud (tolerancia a errores)
        $allProducts = Product::where('active', true)->get(['id', 'name']);
        $suggestions = [];
        foreach ($allProducts as $product) {
            $lev = levenshtein(mb_strtolower($term), mb_strtolower($product->name));
            $sim = similar_text(mb_strtolower($term), mb_strtolower($product->name), $percent);
            // Si la distancia es pequeña o la similitud es alta, sugerir
            if ($lev <= 2 || $percent > 70) {
                $suggestions[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'suggestion' => true
                ];
            }
        }
        // Limitar sugerencias
        $suggestions = array_slice($suggestions, 0, 5);
        return response()->json($suggestions);
    }
} 