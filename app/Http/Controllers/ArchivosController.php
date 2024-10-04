<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
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
        $archivos = Archivos::where('carpeta_id', $id_carpeta)->get();
        return view('panel.archivos.create',compact('id_carpeta','archivos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_carpeta)
{

    // Verificar que el archivo se subió correctamente
    if ($request->hasFile('archivo')) {
        $file = $request->file('archivo');
        $path = $file->store('archivos');

        

        // Guardar el archivo en la base de datos
        $archivos = new Archivos();
        $archivos->nombre_archivo = request('nombre_archivo');
        $archivos->archivo = $path;
        $archivos->numero_documento = request('numero_documento');
        $archivos->numero_resolucion = request('numero_resolucion');
        $archivos->nombres = request('nombres');
        $archivos->apellidos = request('apellidos');
        $archivos->tipo = request('tipo');
        $archivos->carpeta_id = $id_carpeta;
        $archivos->save();

        return redirect()->route('archivo.create', $id_carpeta)->with('success', 'Archivo guardado correctamente.');
    }

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
        $archivo = Archivos::find($id_archivo); // Encuentra el archivo existente
    
        if ($archivo) {
            // Actualiza los campos con los valores del formulario
            $archivo->nombre_archivo = request('nombre_archivo');
            $archivo->numero_documento = request('numero_documento');
            $archivo->numero_resolucion = request('numero_resolucion');
            $archivo->nombres = request('nombres');
            $archivo->apellidos = request('apellidos');
            $archivo->tipo = request('tipo');
            $archivo->id;;

            $archivo->save();

    
            return redirect()->route('archivo.create', $archivo->carpeta_id)->with('success', 'Archivo actualizado correctamente.');
        } else {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_archivo)
    {
        $archivo = Archivos::find($id_archivo);
        if (!$archivo) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }
    
        $archivo->delete();
        return redirect()->route('archivo.create')->with('success', 'Archivo eliminado correctamente.');
    }
    

}
