<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medida;
use App\Models\Material;

class MaterialController extends Controller
{
    public function Materiales()
    {

        $materiales = Material::with('medida')->orderBy('created_at', 'desc')->get();

        return view('Intranet/Materiales/materiales', ['materiales' => $materiales]);

    }
    public function Buscarmateriales(Request $request)
    {
        $filtro = $request->nombrema;
        $materiales = Material::with('medida')
        ->where('nombrema', 'LIKE', '%' . $request->nombrema . '%')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('Intranet/Materiales/Buscarmateriales', ['materiales' => $materiales,'filtro' => $filtro]);

    }
    public function CrearMaterial()
    {
        $Medidas = Medida::all();
        return view('Intranet/Materiales/CrearMaterial', ['Medidas' => $Medidas]);
    }
    public function RegistrarMaterial(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrema' => 'required|string|max:255',
            'cantidad_seguridad' => 'required|integer',
            'id_medida' => 'required|exists:medida,id_medida'
        ]);

        // Crear un nuevo material con los datos del formulario
        $material = new Material([
            'nombrema' => $request->nombrema,
            'cantidad_seguridad' => $request->cantidad_seguridad,
            'id_medida' => $request->id_medida
        ]);

        // Guardar el nuevo material en la base de datos
        $material->save();

        // Redireccionar a la página principal con un mensaje de éxito
        return redirect()->route('Materiales')->with('success', 'Material creado correctamente');
    }
    public function eliminarMaterial($id)
    {
        // Buscar el material por su ID
        $material = Material::find($id);

        // Verificar si se encontró el material
        if ($material) {
            // Eliminar el material
            $material->delete();

            // Redireccionar a la página principal con un mensaje de éxito
            return redirect()->route('Materiales')->with('success', 'Material eliminado correctamente');
        } else {
            // Redireccionar a la página principal con un mensaje de error si no se encuentra el material
            return redirect()->route('Materiales')->with('error', 'Material no encontrado');
        }
    }
    public function examinarMaterial($id)
    {
        $Medidas = Medida::all();
        $material = Material::with('medida')->find($id);
        return view('Intranet/Materiales/ModificarMaterial', ['material' => $material,'Medidas' => $Medidas]);
    }

    public function modificarMaterial($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombrema' => 'required|string|max:255',
            'cantidad_seguridad' => 'required|integer',
            'id_medida' => 'required|exists:medida,id_medida'
        ]);
    
        // Buscar el material por su ID
        $material = Material::find($id);
    
        // Actualizar los datos del material
        $material->nombrema = $request->nombrema;
        $material->cantidad_seguridad = $request->cantidad_seguridad;
        $material->id_medida = $request->id_medida;
        $material->save();
    
        // Redirigir a la página de detalles del material o a donde sea necesario
        return redirect()->route('Materiales')->with('success', 'Material modificado correctamente');
    }
}