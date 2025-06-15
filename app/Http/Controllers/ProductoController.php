<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Aquí irá la lógica para obtener los productos
        return view('productos.index');
    }

    public function show($id)
    {
        // Aquí irá la lógica para mostrar un producto específico
        return view('productos.show', compact('id'));
    }
} 