<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB; 
use App\Models\Ubicacion;
use App\Models\Almacen;
use App\Models\MaterialAlmacen;
use App\Models\Salida;
use App\Models\Entrada;
use App\Models\Material;
use App\Models\Medida;






class IntranetController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function dashboard()
    {
        // Suma de los últimos 12 meses
        $suma12 = DB::table('entrada')
            ->where('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 12 MONTH)'))
            ->sum('valor');
    
        // Suma de los últimos 6 meses
        $suma6 = DB::table('entrada')
            ->where('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 6 MONTH)'))
            ->sum('valor');
    
        // Suma de los últimos 1 mes
        $suma1 = DB::table('entrada')
            ->where('created_at', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 1 MONTH)'))
            ->sum('valor');
    
        // Obtener los otros datos para el dashboard
        $datos = DB::table('ubicacion as u')
            ->select('u.nombreu', DB::raw('SUM(e.cantidad) as suma_entrada'), DB::raw('COALESCE(SUM(s.cantidad), 0) as suma_salida'), 'm.nombrema', 'm.cantidad_seguridad', 'me.nombrem')
            ->join('almacen as a', 'u.id_ubicacion', '=', 'a.id_ubicacion')
            ->join('material_almacen as ma', 'a.id_almacen', '=', 'ma.id_almacen')
            ->join('material as m', 'm.id_material', '=', 'ma.id_material')
            ->join('medida as me', 'me.id_medida', '=', 'm.id_medida')
            ->leftJoin('entrada as e', 'e.id_mat_alm', '=', 'ma.id_mat_alm')
            ->leftJoin('salida as s', 's.id_mat_alm', '=', 'ma.id_mat_alm')
            ->groupBy('u.id_ubicacion', 'ma.id_material','u.nombreu','m.nombrema','m.cantidad_seguridad','me.nombrem')
            ->havingRaw('(SUM(e.cantidad) - COALESCE(SUM(s.cantidad), 0)) < m.cantidad_seguridad')
            ->get();
    
        // Pasar todas las variables al dashboard
        return view('Intranet/dashboard', [
            'datos' => $datos,
            'suma12' => $suma12,
            'suma6' => $suma6,
            'suma1' => $suma1
        ]);
    }
}


