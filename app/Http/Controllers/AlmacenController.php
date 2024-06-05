<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\Almacen;

class AlmacenController extends Controller
{
    public function Almacenes()
    {
        // Obtener todos los almacenes con sus ubicaciones correspondientes
        $almacenes = Almacen::with('ubicacion')->get();

        // Devolver la vista 'Intranet/Almacenes/almacenes' con los almacenes y las ubicaciones
        return view('Intranet/Almacenes/almacenes', ['almacenes' => $almacenes]);
    }
    public function CrearAlmacen()
    {
        $Ubicaciones = Ubicacion::all();
        return view('Intranet/Almacenes/CrearAlmacen', ['Ubicaciones' => $Ubicaciones]); 
    }
    public function registrarAlmacen(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrea' => 'required|string|max:255',
            'ubicacion_id' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        // Crear un nuevo almacen
        $almacen = new Almacen();
        $almacen->nombrea = $request->nombrea;
        $almacen->id_ubicacion = $request->ubicacion_id;
        $almacen->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('Almacenes')->with('success', 'Almacen creado correctamente');
    }
    public function eliminarAlmacen($id)
    {
        // Buscar el almacén por su ID
        $almacen = Almacen::find($id);
    
        // Verificar si se encontró el almacén
        if (!$almacen) {
            // Si el almacén no existe, redirigir con un mensaje de error
            return redirect()->route('Almacenes')->with('error', 'El almacén no existe.');
        }
    
        // Eliminar el almacén
        $almacen->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('Almacenes')->with('success', 'El almacén ha sido eliminado correctamente.');
    }
    public function examinarAlmacen($id)
    {
        // Obtener el almacén con su ubicación correspondiente
        $almacen = Almacen::with('ubicacion')->find($id);
        $Ubicaciones = Ubicacion::all();
        // Verificar si se encontró el almacén
        if (!$almacen) {
            // Si el almacén no existe, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'El almacén no existe.');
        }
    
        // Devolver la vista 'Intranet/Almacenes/almacenes' con el almacén y su ubicación
        return view('Intranet/Almacenes/ModificarAlmacen', ['almacen' => $almacen,'Ubicaciones' => $Ubicaciones]);
    }

    public function modificarAlmacen($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrea' => 'required|string|max:255',
            'ubicacion_id' => 'required|exists:ubicacion,id_ubicacion',
        ]);
    
        try {
            // Encontrar el almacén por su ID
            $almacen = Almacen::findOrFail($id);
    
            // Actualizar los datos del almacén
            $almacen->update([
                'nombrea' => $request->input('nombrea'),
                'id_ubicacion' => $request->input('ubicacion_id'),
            ]);
            // Redirigir con un mensaje de éxito
            return redirect()->route('Almacenes')->with('success', 'Almacén modificado correctamente');
        } catch (\Throwable $th) {
            // Si ocurre un error, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Se produjo un error al modificar el almacén');
        }
    }
}