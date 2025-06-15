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

        // Filtrar por categoría
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
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

        $products = $query->paginate(12);
        $categories = Category::where('active', true)->get();

        return view('products.index', compact('products', 'categories'));
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