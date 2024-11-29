<?php

namespace App\Http\Controllers;

use App\Models\carpetas;
use App\Models\solicitudes;
use Illuminate\Http\Request;

class CarpetasController extends Controller
{
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
        // $carpetas = Carpetas::orderBy('id', 'desc')->get();
        // $solicitudes_carpetas=solicitudes::where('estado',1)
        // ->where('recurso','carpeta')
        // ->where('user_id',auth()->id())
        // ->get();

        // return view('panel.carpetas.create',compact('carpetas','solicitudes_carpetas'));

        $carpetas = Carpetas::orderBy('id', 'desc')->paginate(2);
        $solicitudes_carpetas = solicitudes::where('estado', 1)
            ->where('recurso', 'carpeta')
            ->where('user_id', auth()->id())
            ->get();
            // Asignar una columna adicional en carpetas si existe una solicitud correspondiente
            foreach ($carpetas as $carpeta) {
                $solicitud = $solicitudes_carpetas->firstWhere('id_recurso', $carpeta->id);
                $carpeta->solicitud = $solicitud ? $solicitud->id : null; // Agrega el ID de solicitud o null
                $carpeta->accion = $solicitud ? $solicitud->accion : null; // Agrega la acción de la solicitud o null
                $carpeta->estado = $solicitud ? $solicitud->estado : null; // Agrega el estado de la solicitud o null
            }
            
            // dd($carpetas);
            
            
        
        return view('panel.carpetas.create', compact('carpetas', 'solicitudes_carpetas'));



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carpeta  = new carpetas();
        $carpeta->nombre=request('nombre');
        $carpeta->sede=request('sede');
        $carpeta->numero_almacen=request('numero_almacen');
        $carpeta->numero_estante=request('numero_estante');
        $carpeta->anho=request('anho');
        $carpeta->seccion=request('seccion');
        $carpeta->user_id=auth()->id();
        $carpeta->save();

        
        return redirect()->route('carpeta.create')->with('success', 'Carpeta guardada correctamente.');


    }

    /**
     * Display the specified resource.
     */
    public function show(archivos $archivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_carpeta)
    {
        $carpeta = carpetas::find($id_carpeta);
        return view('panel.carpetas.update',compact('carpeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_carpeta = request('carpeta_id');
        $carpeta = carpetas::find($id_carpeta);

        $carpeta->nombre=request('nombre');
        $carpeta->sede=request('sede');
        $carpeta->numero_almacen=request('numero_almacen');
        $carpeta->numero_estante=request('numero_estante');
        $carpeta->anho=request('anho');
        $carpeta->seccion=request('seccion');
        $carpeta->user_id=auth()->id();;
        $carpeta->save();

        
        return redirect()->route('carpeta.create')->with('success', 'Carpeta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id_carpeta=$request->input('id_carpeta_eliminar');
        $carpeta = carpetas::find($id_carpeta);
        $carpeta->delete();

        if (!$carpeta) {
            return redirect()->back()->with('error', 'Carpeta no encontrado.');
        }

        //actualizar el campo de estado a 2
        $solicitud = solicitudes::where('id_recurso', $id_carpeta)->first();

        if ($solicitud) {
        $solicitud->estado = 2;
        $solicitud->save();
        }


        return redirect()->route('carpeta.create')->with('success', 'Carpeta eliminado correctamente.');
    }
}
