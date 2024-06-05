<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Salida;
use App\Models\Entrada;
use App\Models\MaterialAlmacen;
use App\Models\Ubicacion;
use App\Models\Almacen;
use App\Models\Material;

class SalidaController extends Controller
{
    public function Salidas($id)
    {
        $salidas = $this->getSalidas($id);
        return view('Intranet/Salidas/Salidas', ['salidas' => $salidas ,'id_ubicacion' => $id]);

    }
    private function getSalidas($id)
    {
        return Salida::select('salida.*')
        ->join('material_almacen as m_a', 'm_a.id_mat_alm', '=', 'salida.id_mat_alm')
        ->join('almacen as a', 'a.id_almacen', '=', 'm_a.id_almacen')
        ->join('ubicacion as u', 'u.id_ubicacion', '=', 'a.id_ubicacion')
        ->join('material as m', 'm.id_material', '=', 'm_a.id_material')
        ->where('a.id_ubicacion', $id)
        ->with(['materialAlmacen.material', 'materialAlmacen.almacen', 'materialAlmacen.almacen.ubicacion'])
        ->orderBy('salida.created_at', 'desc') // Ordenar por fecha y hora más antigua
        ->get();
    }
    public function CrearSalida($id)
    {
        $salidas = $this->getSalidas($id);

        $ubicacion = Ubicacion::find($id);
        $almacenes = Almacen::where('id_ubicacion', $id)->get();

        $materiales = Material::all();
    
        return view('Intranet/Salidas/CrearSalidas', ['salidas' => $salidas, 'ubicacion' => $ubicacion, 'almacenes' => $almacenes, 'materiales' => $materiales]);

    }
    public function RegistrarSalida($id, Request $request)
    {
            // Validar los datos del formulario
    $request->validate([
        'id_almacen' => 'required',
        'id_mat_alm' => 'required',
        'cantidad' => 'required|numeric|min:0',
    ]);

    // Verificar si la cantidad supera la suma_cantidad
    $idMatAlm = $request->id_mat_alm;
    $sumaCantidad = $this->obtenerSumaCantidad($idMatAlm);
    $cantidad = $request->cantidad;

    if ($cantidad > $sumaCantidad) {
        return redirect()->route('CrearSalida', ['id' => $id])->with('error', 'La cantidad no puede superar la suma de cantidad');
    }

    // Crear una nueva salida
    $salida = new Salida();
    $salida->id_mat_alm = $request->id_mat_alm;
    $salida->cantidad = $request->cantidad;
    $salida->save();
    return redirect()->route('Salidas', ['id' => $id])->with('success', 'Salida registrada correctamente');;
    }
    public function eliminarSalida($id,$idSalida)
    {
        try {
            $salida = Salida::findOrFail($idSalida);
            $salida->delete();
            
            return redirect()->back()->with('success', 'La salida se eliminó correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar la salida.');
        }
    }
    public function obtenerSumaCantidad($idMatAlm)
    {
        // Sumar la cantidad de la tabla entrada
        $sumaEntrada = Entrada::where('id_mat_alm', $idMatAlm)->sum('cantidad');
    
        // Restar la cantidad de la tabla salida
        $restaSalida = Salida::where('id_mat_alm', $idMatAlm)->sum('cantidad');
    
        // Calcular la suma total restando la cantidad de salida
        $sumaTotal = $sumaEntrada - $restaSalida;
    
        return $sumaTotal;
    }
    public function obtenerSumaCantidadPorIdMatAlm(Request $request)
    {
        try {
            $idMatAlm = $request->id_mat_alm;
            $sumaCantidad = $this->obtenerSumaCantidad($idMatAlm);
            
            return response()->json(['sumaCantidad' => $sumaCantidad]);
        } catch (\Exception $e) {
            // Captura cualquier excepción y devuelve un mensaje de error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}