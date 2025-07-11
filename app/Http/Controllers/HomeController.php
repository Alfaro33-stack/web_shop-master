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
        $frutasCategory = $categories->where('name', 'Frutas')->first();
        $featuredProducts = collect();
        if ($frutasCategory) {
            $featuredProducts = Product::where('active', true)
                ->where('category_id', $frutasCategory->id)
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        }
        return view('home', compact('categories', 'featuredProducts'));
    }

    public function perfil()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('items.product')->orderBy('created_at', 'desc')->get();

        if ($user->isAdmin()) {
            // Últimos 10 usuarios registrados
            $latestUsers = \App\Models\User::orderBy('created_at', 'desc')->take(10)->get();

            // Ventas del día
            $today = now()->startOfDay();
            $ordersToday = \App\Models\Order::where('created_at', '>=', $today)->with('user')->get();
            $totalOrdersToday = $ordersToday->count();
            $totalSalesToday = $ordersToday->sum('total');

            // Ventas por hora (para gráfico)
            $salesByHour = $ordersToday->groupBy(function($order) {
                return $order->created_at->format('H');
            })->map(function($orders) {
                return $orders->sum('total');
            });

            // Top 10 productos más vendidos
            $topProducts = \App\Models\OrderItem::selectRaw('product_id, SUM(quantity) as total_quantity, SUM(price * quantity) as total_sales')
                ->groupBy('product_id')
                ->orderByDesc('total_quantity')
                ->take(10)
                ->with('product')
                ->get();

            // Usuarios por día (últimos 14 días, para gráfico)
            $usersByDay = \App\Models\User::where('created_at', '>=', now()->subDays(13)->startOfDay())
                ->get()
                ->groupBy(function($user) {
                    return $user->created_at->format('Y-m-d');
                })->map(function($users) {
                    return $users->count();
                });

            return view('perfil', compact(
                'user',
                'orders',
                'latestUsers',
                'totalOrdersToday',
                'totalSalesToday',
                'salesByHour',
                'topProducts',
                'usersByDay'
            ));
        }

        return view('perfil', compact('user', 'orders'));
    }

    public function updatePerfil(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'edad' => 'nullable|integer|min:0|max:120',
            'fecha_nacimiento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:20',
            'dni' => 'nullable|string|max:12|unique:users,dni,' . $user->id,
            'celular' => 'required|string|max:20|unique:users,celular,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
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
