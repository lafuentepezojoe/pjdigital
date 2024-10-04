@extends('panel.base')
@section('contenido')
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{route('carpeta.store')}}" method="POST">@csrf
        <h5>Formulario de Registro de Carpeta</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="nombre">Nombre de Carpeta</label>
                <input type="text" name="nombre" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label for="sede">Sede</label>
                <input type="text" name="sede" class="form-control form-control-sm">            
            </div>

            <div class="col-md-2">
                <label for="numero_almacen">Número Almacén</label>
                <input type="number" name="numero_almacen" class="form-control form-control-sm">
        
            </div>
            <div class="col-md-2">
                <label for="numero_estante">Número Estante</label>
                <input type="number" name="numero_estante" class="form-control form-control-sm">
            </div>

            <div class="col-md-4">
                <label for="anho">Año</label>
                <input type="number" name="anho" class="form-control form-control-sm">
            </div>

        </div>

        <br>
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
    </form>
    <br>
    {{-- Tabla --}}
    <h5>Listado de Carpetas</h5>
    <table class="table table-responsive table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Sede</th>
                <th>Número Almacén</th>
                <th>Número Estante</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($carpetas as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->nombre}}</td>
                    <td>{{$c->sede}}</td>
                    <td>{{$c->numero_almacen}}</td>
                    <td>{{$c->numero_estante}}</td>
                    <td>{{$c->anho}}</td>
                    <td>
                        <a href="{{route('carpeta.edit',$c->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{route('carpeta.destroy',$c->id)}}" class="btn btn-danger btn-sm">Eliminar</a>
                        <a href="{{route('archivo.create',$c->id)}}" class="btn btn-info btn-sm">Archivos</a>
                    </td>
                </tr>  
            @endforeach
        </tbody>
    </table>


@endsection