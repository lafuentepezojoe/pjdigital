<?php

namespace App\Http\Controllers;

use App\Models\solicitudes;
use App\Models\carpetas;
use App\Models\archivos;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function carpetayarchivos()
    {
        $solicitudes= solicitudes::all();
        $carpetas = carpetas::paginate(2);
        $archivos = archivos::all();
        return view('panel.solicitudes.carpetasyarchivos',compact('solicitudes','carpetas','archivos'));
    }

    public function index(){
        $solicitudes = Solicitudes::orderBy('id', 'desc')->paginate(5);
        return view('panel.solicitudes.index',compact('solicitudes'));
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
        $id_recurso=$request->input('id_recurso');
        $recurso=$request->input('recurso');
        $accion=$request->input('accion');
        $comentario=$request->input('comentario');
        
        $solicitudes = new solicitudes();
        $solicitudes->id_recurso = $id_recurso;
        $solicitudes->recurso = $recurso;
        $solicitudes->accion=$accion;
        $solicitudes->comentario=$comentario;
        $solicitudes->estado=0;
        $solicitudes->user_id=auth()->id();
        $solicitudes->save();
        return redirect()->route('solicitudes.carpetayarchivos')->with('success','Solicitud Registrada');

    }


    public function aprobar(Request $request){
        $id_solicitud=$request->input('id_solicitud');
        $solicitud = solicitudes::find($id_solicitud);
        $solicitud->estado=1;   
        // $solicitud->leido=false;
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success','solicitud aprobada');

    }

    public function rechazar(Request $request){
        $id_solicitud=$request->input('id_solicitud_rech');
        
        $solicitud = solicitudes::find($id_solicitud);

        $solicitud->estado=2;   
        // $solicitud->liedo=false;
        $solicitud->save();

        return redirect()->route('solicitudes.index')->with('success','solicitud rechazada');

    }
    
    public function marcarComoLeido()
    {
        if (auth()->check()) {
            Solicitudes::where('user_id', auth()->id())
                ->whereIn('estado', [1,2])
                ->update(['leido' => true]);

            return response()->json(['message' => 'Notificaciones marcadas como leídas.'], 200);
        }

        return response()->json(['error' => 'No autorizado.'], 403);
    }

    public function notificaciones()
    {
        $notificaciones = Solicitudes::where(
            'user_id', auth()->id())
            ->where('leido', false)
            ->whereIn('estado', [1, 2])
            ->select('id_recurso','recurso','accion','estado')
            ->get();
        return response()->json($notificaciones, 200);
    }


    public function show(solicitudes $solicitudes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(solicitudes $solicitudes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, solicitudes $solicitudes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(solicitudes $solicitudes)
    {
        //
    }
}
