<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class navbarController extends Controller
{
    public function navbar()
    {
        // Obtén las ubicaciones desde tu modelo
        $ubicaciones = Ubicacion::all();

        // Devuelve la vista 'Intranet/navbar' con las ubicaciones
        return view('Intranet/navbar', ['ubicaciones' => $ubicaciones]);
    }
}