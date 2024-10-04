<?php

namespace App\Http\Controllers;

use App\Models\carpetas;
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
        $carpetas = Carpetas::orderBy('id', 'desc')->get();
        return view('panel.carpetas.create',compact('carpetas'));
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
        $carpeta->user_id=auth()->id();;
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
        $carpeta->user_id=auth()->id();;
        $carpeta->save();

        
        return redirect()->route('carpeta.create')->with('success', 'Carpeta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_carpeta)
    {
        $carpeta = carpetas::find($id_carpeta);
        $carpeta->delete();

        return redirect()->route('carpeta.create');
    }
}
