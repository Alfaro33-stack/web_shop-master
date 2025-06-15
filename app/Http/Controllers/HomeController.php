<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('active', true)->get();
        $featuredProducts = Product::where('active', true)
                                 ->orderBy('created_at', 'desc')
                                 ->take(4)
                                 ->get();
        return view('home', compact('categories', 'featuredProducts'));
    }

    public function perfil()
    {
        return view('perfil');
    }

    public function misPedidos()
    {
        $orders = auth()->user()->orders()->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function carrito()
    {
        return view('cart.index');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }
}
