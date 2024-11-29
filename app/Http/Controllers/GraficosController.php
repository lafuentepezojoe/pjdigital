<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\solicitudes;
use App\Models\Carpetas;
use Illuminate\Http\Request;

class GraficosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function chart_carpetas()
    {
        $cant_carpetas = Carpetas::all()->count();
        return response()->json(['data'=>$cant_carpetas], 200);
    }

    public function chart_archivos()
    {
        $cant_archivos = Archivos::all()->count();
        return response()->json(['data'=>$cant_archivos], 200);
    }
    
    public function chart_caprarch()
    {
        $cant_archivos = Archivos::all()->count();
        $cant_carpetas = Carpetas::all()->count();
        $total=$cant_archivos+$cant_carpetas;
        return response()->json(['data'=>[
            'total'=>$total,
            'cant_archivos'=>$cant_archivos,
            'cant_carpetas'=>$cant_carpetas,
            ]], 200);
    }


    
    
}
