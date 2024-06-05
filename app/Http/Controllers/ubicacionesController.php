<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class ubicacionesController extends Controller
{
    public function ubicaciones()
    {
        $Ubicaciones = Ubicacion::all();
        return view('Intranet/Ubicaciones/ubicaciones', ['Ubicaciones' => $Ubicaciones]);
    }
    public function CrearUbicacion()
    {
        return view('Intranet/Ubicaciones/CrearUbicacion');
    }
    public function registrarUbicacion(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreu' => 'required|string|max:255',
        ]);

        // Crear una nueva ubicación
        Ubicacion::create([
            'nombreu' => $request->nombreu,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('ubicaciones')->with('success', 'Ubicación creada correctamente');
    }
    public function eliminarUbicacion($id)
    {
        $Ubicacion = Ubicacion::find($id);
        if (!$Ubicacion) {
            return redirect()->route('ubicaciones')->with('error', 'Usuario no encontrado');
        }
        $Ubicacion->delete();
        return redirect()->route('ubicaciones')->with('success', 'Unidad de medida eliminado correctamente');
    }
    public function examinarUbicacion($id)
    {
        $ubicacion = Ubicacion::find($id);
        return view('Intranet/Ubicaciones/ModificarUbicacion', ['ubicacion' => $ubicacion]);
    }

    public function modificarUbicacion($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombreu' => 'required|string|max:255',
        ]);
    
        // Buscar la ubicación a modificar
        $ubicacion = Ubicacion::findOrFail($id);
    
        // Actualizar el nombre de la ubicación
        $ubicacion->nombreu = $request->nombreu;
        $ubicacion->save();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('ubicaciones')->with('success', 'Ubicación modificada correctamente');
    }
}