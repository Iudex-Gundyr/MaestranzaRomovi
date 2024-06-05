<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialAlmacen;
use App\Models\Ubicacion;
use App\Models\Almacen;
use App\Models\Material;
use Illuminate\Support\Facades\DB; 

class MaterialAlmacenController extends Controller
{
        
    private function getMaterialAlmacenData($id)
    {
        return MaterialAlmacen::whereHas('almacen', function ($query) use ($id) {
            $query->whereHas('ubicacion', function ($query) use ($id) {
                $query->where('id_ubicacion', $id);
            });
        })->with(['material', 'almacen', 'almacen.ubicacion'])->get();
    }
    public function MaterialAlmacen($id)
    {
        $matalm = $this->getMaterialAlmacenData($id);
        $datos = DB::table('ubicacion as u')
            ->select('u.nombreu', DB::raw('SUM(e.cantidad) as suma_entrada'), DB::raw('COALESCE(SUM(s.cantidad), 0) as suma_salida'), 'm.nombrema', 'm.cantidad_seguridad', 'me.nombrem')
            ->join('almacen as a', 'u.id_ubicacion', '=', 'a.id_ubicacion')
            ->join('material_almacen as ma', 'a.id_almacen', '=', 'ma.id_almacen')
            ->join('material as m', 'm.id_material', '=', 'ma.id_material')
            ->join('medida as me', 'me.id_medida', '=', 'm.id_medida')
            ->leftJoin('entrada as e', 'e.id_mat_alm', '=', 'ma.id_mat_alm')
            ->leftJoin('salida as s', 's.id_mat_alm', '=', 'ma.id_mat_alm')
            ->groupBy('u.id_ubicacion', 'ma.id_material','u.nombreu','m.nombrema','m.cantidad_seguridad','me.nombrem')
            ->get();
        return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id, 'datos' => $datos]);
    }
    public function buscarMaterialAlmacen($id,Request $request){
        $matalm = $this->getMaterialAlmacenData($id);
        $datos = DB::table('ubicacion as u')
        ->select('u.nombreu', DB::raw('SUM(e.cantidad) as suma_entrada'), DB::raw('COALESCE(SUM(s.cantidad), 0) as suma_salida'), 'm.nombrema', 'm.cantidad_seguridad', 'me.nombrem')
        ->join('almacen as a', 'u.id_ubicacion', '=', 'a.id_ubicacion')
        ->join('material_almacen as ma', 'a.id_almacen', '=', 'ma.id_almacen')
        ->join('material as m', 'm.id_material', '=', 'ma.id_material')
        ->join('medida as me', 'me.id_medida', '=', 'm.id_medida')
        ->leftJoin('entrada as e', 'e.id_mat_alm', '=', 'ma.id_mat_alm')
        ->leftJoin('salida as s', 's.id_mat_alm', '=', 'ma.id_mat_alm')
        ->groupBy('u.id_ubicacion', 'ma.id_material','u.nombreu','m.nombrema','m.cantidad_seguridad','me.nombrem')
        ->where('m.nombrema', 'LIKE', '%' . $request->nombrema . '%')
        ->get();

        $filtro = $request->nombrema ;
        return view('Intranet/MaterialAlmacen/BuscarMaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id, 'datos' => $datos,'filtro'=>$filtro]);
    }


    public function crearMaterialAlmacen($id, Request $request)
    {
        $matalm = $this->getMaterialAlmacenData($id);

        $ubicacion = Ubicacion::find($id);
        $almacenes = Almacen::where('id_ubicacion', $id)->get();

        $materiales = Material::all();
    
        return view('Intranet/MaterialAlmacen/CrearMaterialAlmacen', ['matalm' => $matalm, 'ubicacion' => $ubicacion, 'almacenes' => $almacenes, 'materiales' => $materiales]);

    }
    public function registrarMaterialAlmacen($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_almacen' => 'required|exists:almacen,id_almacen',
            'id_material' => 'required|exists:material,id_material',
        ]);

        // Verificar si el material ya existe en el almacén
        $existeMaterial = MaterialAlmacen::where('id_almacen', $request->id_almacen)
            ->where('id_material', $request->id_material)
            ->exists();

        if ($existeMaterial) {
            // Material ya existe en el almacén, devolver una redirección con un mensaje de error
            $matalm = $this->getMaterialAlmacenData($id);
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id, 'error' => 'El material ya existe en este almacén.']);


        } else {
            // Crear una nueva instancia de MaterialAlmacen con los datos del formulario
            $materialAlmacen = new MaterialAlmacen();
            $materialAlmacen->id_almacen = $request->id_almacen;
            $materialAlmacen->id_material = $request->id_material;
            $materialAlmacen->save();

            // Redireccionar a la página anterior con un mensaje de éxito
            $matalm = $this->getMaterialAlmacenData($id);
        
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id, 'success' => 'Material registrado correctamente en el almacén.']);
        }
    }

    public function eliminarMaterialAlmacen($id, $id_Mat_Alm)
    {
        // Buscar el registro de MaterialAlmacen por su ID
        $materialAlmacen = MaterialAlmacen::find($id_Mat_Alm);
        // Verificar si el registro existe
        if ($materialAlmacen) {
            // Eliminar el registro de MaterialAlmacen
            $materialAlmacen->delete();
            
            // Obtener los datos actualizados para la vista MaterialAlmacen
            $matalm = $this->getMaterialAlmacenData($id);
    
            // Redireccionar a la vista MaterialAlmacen con un mensaje de éxito
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id])->with('success', 'Material eliminado correctamente del almacén.');
        } else {
            // Obtener los datos actualizados para la vista MaterialAlmacen
            $matalm = $this->getMaterialAlmacenData($id);
    
            // Redireccionar a la vista MaterialAlmacen con un mensaje de error
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id])->with('error', 'No se pudo encontrar el material en el almacén.');
        }
    }

    public function examinarMaterialAlmacen($id,$id_Mat_Alm)
    {
        $matalm = $this->getMaterialAlmacenData($id);
        $id_Mat_Alm = MaterialAlmacen::find($id_Mat_Alm)->id_mat_alm;
        $ubicacion = Ubicacion::find($id);
        $almacenes = Almacen::where('id_ubicacion', $id)->get();
        $almActual = Almacen::find($id);
        $materiales = Material::all();
        $matActual = Material::find($id);
    
        return view('Intranet/MaterialAlmacen/ModificarMaterialAlmacen', ['id_Mat_Alm'=>$id_Mat_Alm,'matalm' => $matalm, 'ubicacion' => $ubicacion, 'almacenes' => $almacenes, 'materiales' => $materiales,'matActual'=>$matActual,'almActual'=>$almActual]);
    }

    public function modificarMaterialAlmacen($id, $id_Mat_Alm, Request $request)
    {
        // Buscar el registro de MaterialAlmacen por su ID
        $materialAlmacen = MaterialAlmacen::find($id_Mat_Alm);
        
        // Verificar si el registro existe
        if ($materialAlmacen) {
            // Validar los datos del formulario
            $request->validate([
                'id_almacen' => 'required|exists:almacen,id_almacen',
                'id_material' => 'required|exists:material,id_material',
            ]);
            
            // Actualizar los datos del MaterialAlmacen con los datos del formulario
            $materialAlmacen->id_almacen = $request->id_almacen;
            $materialAlmacen->id_material = $request->id_material;
            $materialAlmacen->save();
    
            // Obtener los datos actualizados para la vista MaterialAlmacen
            $matalm = $this->getMaterialAlmacenData($id);
    
            // Redireccionar a la vista MaterialAlmacen con un mensaje de error
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id])->with('success', 'Material actualizado correctamente en el almacén.');
        } else {
            // Obtener los datos actualizados para la vista MaterialAlmacen
            $matalm = $this->getMaterialAlmacenData($id);
    
            // Redireccionar a la vista MaterialAlmacen con un mensaje de error
            return view('Intranet/MaterialAlmacen/MaterialAlmacen', ['matalm' => $matalm,'id_ubicacion' => $id])->with('error', 'No se pudo encontrar el material en el almacén.');
        }
    }
}