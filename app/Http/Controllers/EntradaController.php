<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entrada;
use App\Models\MaterialAlmacen;
use App\Models\Ubicacion;
use App\Models\Almacen;
use App\Models\Material;
use App\Models\Salida;
class EntradaController extends Controller
{


    private function getEntradas($id)
    {
        return Entrada::select('entrada.*')
        ->join('material_almacen as m_a', 'm_a.id_mat_alm', '=', 'entrada.id_mat_alm')
        ->join('almacen as a', 'a.id_almacen', '=', 'm_a.id_almacen')
        ->join('ubicacion as u', 'u.id_ubicacion', '=', 'a.id_ubicacion')
        ->join('material as m', 'm.id_material', '=', 'm_a.id_material')
        ->where('a.id_ubicacion', $id)
        ->with(['materialAlmacen.material', 'materialAlmacen.almacen', 'materialAlmacen.almacen.ubicacion'])
        ->orderBy('entrada.created_at', 'desc') // Ordenar por fecha y hora más antigua
        ->get();
    }
    public function Entradas($id)
    {
        $entradas = $this->getEntradas($id);
        
    
        return view('Intranet/Entradas/Entradas', ['entradas' => $entradas ,'id_ubicacion' => $id]);
    }
    public function CrearEntrada($id)
    {
        $entrada = $this->getEntradas($id);

        $ubicacion = Ubicacion::find($id);
        $almacenes = Almacen::where('id_ubicacion', $id)->get();

        $materiales = Material::all();
    
        return view('Intranet/Entradas/CrearEntrada', ['entrada' => $entrada, 'ubicacion' => $ubicacion, 'almacenes' => $almacenes, 'materiales' => $materiales]);
    }

    public function registrarEntrada($id, Request $request)
    {
        $existeMaterial = MaterialAlmacen::where('id_almacen', $request->id_almacen)
        ->where('id_material', $request->id_material)
        ->exists();
        if (!$existeMaterial) {
            $materialAlmacen = new MaterialAlmacen();
            $materialAlmacen->id_almacen = $request->id_almacen;
            $materialAlmacen->id_material = $request->id_material;
            $materialAlmacen->save();
            $id_mat_alm = MaterialAlmacen::where('id_material',$request->id_material)->first();
        }else{
            $id_mat_alm = MaterialAlmacen::where('id_material',$request->id_material)->first();
        }
        $existeSalida  = Salida::where('id_mat_alm', $id_mat_alm->id_mat_alm)->exists();
        if(!$existeSalida){
            $salida = new Salida();
            $salida->id_mat_alm = $id_mat_alm->id_mat_alm;
            $salida->cantidad = 0;
            $salida->save();
        }
        $request->validate([
            'id_almacen' => 'required',
            'id_material' => 'required',
            'cantidad' => 'required|numeric|min:0', // Elimina la regla de expresión regular
            'valor' => 'required|numeric|min:0',
        ]);
        
        // Normaliza el formato del número decimal (acepta punto o coma como separador decimal)
        $cantidad = str_replace(',', '.', $request->cantidad);
    
        // Crear una nueva entrada
        $entrada = new Entrada();
        $entrada->id_mat_alm = $id_mat_alm->id_mat_alm;
        $entrada->cantidad = $cantidad; // Usa el valor normalizado
        $entrada->valor = $request->valor;
        $entrada->save();
    
        return redirect()->route('Entradas', ['id' => $id])->with('success', 'Entrada registrada correctamente');
    }
    public function eliminarEntrada($id, $idEntrada)
    {
        // Buscar la entrada por su ID
        $entrada = Entrada::find($idEntrada);
    
        // Verificar si la entrada existe
        if ($entrada) {
            // Eliminar la entrada
            $entrada->delete();
    
            // Redireccionar a la página de entradas con un mensaje de éxito
            return redirect()->route('Entradas', $id)->with('success', 'Entrada eliminada correctamente');
        } else {
            // Si la entrada no existe, redireccionar con un mensaje de error
            return redirect()->route('Entradas', $id)->with('error', 'La entrada no se encontró');
        }
    }
    public function obtenerMateriales($id)
    {
        $materiales = MaterialAlmacen::where('id_almacen', $id)->with('material')->get();
        
        return response()->json($materiales);
    }

}