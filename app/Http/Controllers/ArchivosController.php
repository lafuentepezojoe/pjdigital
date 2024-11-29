<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\solicitudes;
use App\Models\Carpetas;
use Illuminate\Http\Request;

class ArchivosController extends Controller
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
    public function create($id_carpeta)
{   
    $archivo = Archivos::orderBy('id', 'desc')->first();

    // Obtener la carpeta y los archivos relacionados con el id_carpeta
    $archivos = Archivos::where('carpeta_id', $id_carpeta)->paginate(1);
    $carpeta = Carpetas::find($id_carpeta);

    // Obtener las solicitudes relacionadas con los archivos
    $solicitudes_archivos = solicitudes::where('estado', 1)
        ->where('recurso', 'archivo')
        ->where('user_id', auth()->id())
        ->get();

    // Asignar valores adicionales a cada archivo si existe una solicitud correspondiente
    foreach ($archivos as $archivo) {
        $solicitud = $solicitudes_archivos->firstWhere('id_recurso', $archivo->id);
        $archivo->solicitud = $solicitud ? $solicitud->id : null; // Agrega el ID de solicitud o null
        $archivo->accion = $solicitud ? $solicitud->accion : null; // Agrega la acción de la solicitud o null
        $archivo->estado = $solicitud ? $solicitud->estado : null; // Agrega el estado de la solicitud o null
    }

    // Retornar la vista con los datos de carpeta y archivos
    return view('panel.archivos.create', compact('carpeta', 'archivos', 'solicitudes_archivos'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_carpeta)
{
    
        $archivos = new Archivos();
        // Verificar que el archivo se subió correctamente
        if ($request->hasFile('archivo')){
            $file = request('archivo')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('archivo')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('archivo')->storeAs('archivos/',$archivo,'public');//refiere carpeta publica es el nombre de disco
            $archivos->archivo = $archivo;
        }
        // Guardar el archivo en la base de datos
        $archivos->nombre_archivo = request('nombre_archivo');
        $archivos->numero_documento = request('numero_documento');
        $archivos->numero_resolucion = request('numero_resolucion');
        $archivos->nombres = request('nombres');
        $archivos->apellidos = request('apellidos');
        $archivos->dni= request('dni');
        $archivos->tipo = request('tipo');
        $archivos->carpeta_id = $id_carpeta;
        $archivos->save();

        return redirect()->route('archivo.create', $id_carpeta)->with('success', 'Archivo guardado correctamente.');
    

    return redirect()->back()->with('error', 'No se pudo subir el archivo.');
}


    
    /**
     * Display the specified resource.
     */
    public function show(Archivos $archivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_archivo)
{
    $archivo = Archivos::find($id_archivo); // Cambia $archivos a $archivo
    if ($archivo) {
        return view('panel.archivos.update', compact('archivo')); // Cambia $archivos a $archivo
    } else {
        return redirect()->back()->with('error', 'Archivo no encontrado.');
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archivos $archivos)
    {
        $id_archivo = request('archivo_id');
        
        $archivos = Archivos::find($id_archivo); // Encuentra el archivo existente
        if ($archivos) {

            if ($request->hasFile('archivo')){
                $file = request('archivo')->getClientOriginalName();//archivo recibido
                $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                $extension = request('archivo')->getClientOriginalExtension();//extensión
                $archivo= $filename.'_'.time().'.'.$extension;//
                request('archivo')->storeAs('archivos/',$archivo,'public');//refiere carpeta publica es el nombre de disco
                $archivos->archivo = $archivo;
            }
            // Actualiza los campos con los valores del formulario
            $archivos->numero_documento = request('numero_documento');
            $archivos->nombre_archivo = request('nombre_archivo');
            $archivos->numero_resolucion = request('numero_resolucion');
            $archivos->nombres = request('nombres');
            $archivos->apellidos = request('apellidos');
            $archivos->dni = request('dni');
            $archivos->tipo = request('tipo');
            $archivos->id;;

            $archivos->save();

    
            return redirect()->route('archivo.create', $archivos->carpeta_id)->with('success', 'Archivo actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id_archivo=$request->input('id_archivo_eliminar');
        $archivo = Archivos::find($id_archivo);
        
        if (!$archivo) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        
            //actualizar el campo de estado a 2
            $solicitud = solicitudes::where('id_recurso', $id_archivo)->first();

            if ($solicitud) {
            $solicitud->estado = 2;
            $solicitud->save();
            }
        
        $id_carpeta= $archivo->carpeta_id;
        $archivo->delete();
        return redirect()->route('archivo.create',$id_carpeta)->with('success', 'Archivo eliminado correctamente.');
    }
    

}
