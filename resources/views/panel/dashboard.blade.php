@extends('panel.base')
@section('contenido')
    <h5>Bienvenido al panel</h5>
    <a href="{{route('carpeta.create')}}" class="form form-class">Crear Carpeta</a>
    @auth
        <p>Bienvenido, {{ Auth::user()->name }}</p>

    @endauth



@endsection