<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\archivos;
use DB;

class ProfesoresController extends Controller
{
    
public function buscar(Request $request)
    {
        $termino = $request->input('nombres');

        $resultados = DB::table('archivos')
            ->where(function ($query) use ($termino) {
                $query->where('archivos.nombres', 'like', '%' . $termino . '%')
                    ->orWhere('archivos.apellidos', 'like', '%' . $termino . '%')
                    ->orWhere('archivos.dni', 'like', '%' . $termino . '%');
                    
            })
            ->leftjoin('carpetas','carpetas.id','=','archivos.carpeta_id')
            ->select(
                'carpetas.nombre as nombre_carpeta',
                'carpetas.seccion',
                'carpetas.numero_estante',
                'carpetas.numero_almacen',
                'archivos.*')
            ->get();
        
        // dd($resultados);
        
        return view('panel.profesores.resultado_busqueda',compact('resultados'));
    }
    



















            

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
