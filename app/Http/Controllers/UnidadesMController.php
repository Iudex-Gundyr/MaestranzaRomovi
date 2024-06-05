<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medida;

class UnidadesMController extends Controller
{
    public function unidadesMedidas()
    {
        $medidas = Medida::all();
        return view('Intranet/unidadeMedida/unidadesM', ['medidas' => $medidas]);
    }
    public function CrearUnidadMedida()
    {
        return view('Intranet/unidadeMedida/CrearMedida');
    }
    public function RegistrarUnidadMedida(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrem' => 'required|string|max:255|unique:medida',
        ]);

        // Crear una nueva unidad de medida
        Medida::create([
            'nombrem' => $request->nombrem,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('unidadadesMedidas')->with('success', 'Unidad de medida creada correctamente');
    }
    public function eliminarUnidadMedida($id)
    {
        // Buscar el usuario por su ID
        $medidas = Medida::find($id);
        // Verificar si el usuario existe
        if (!$medidas) {
            // Si el usuario no existe, redirige con un mensaje de error
            return redirect()->route('unidadadesMedidas')->with('error', 'Usuario no encontrado');
        }
    
        // Eliminar el usuario
        $medidas->delete();
    
        // Redirigir de vuelta a la página de usuarios con un mensaje de éxito
        return redirect()->route('unidadadesMedidas')->with('success', 'Unidad de medida eliminado correctamente');
    }
    public function exanimarMedida($id)
    {
        $medidas = Medida::find($id);
        return view('Intranet/unidadeMedida/ModificarMedida', ['medidas' => $medidas]);

    }
    public function modificarUnidadMedida($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrem' => 'required|string|max:255',
        ]);
    
        // Buscar la unidad de medida por su ID
        $medida = Medida::findOrFail($id);
    
        // Actualizar los datos de la unidad de medida
        $medida->update([
            'nombrem' => $request->nombrem,
        ]);
    
        $medidas = Medida::all();
        return redirect()->route('unidadadesMedidas')->with('success', 'Unidad de medida modificada correctamente');
    }
}