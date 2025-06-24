<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Muestra la página de contacto.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Esto le dice a Laravel que cargue el archivo de vista
        // ubicado en 'resources/views/contact.blade.php'
        return view('contact');
    }
}
