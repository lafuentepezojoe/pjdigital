@extends('panel.base')
@section('contenido')
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    

    <form action="{{route('archivo.store', $id_carpeta)}}" method="POST" enctype="multipart/form-data" >@csrf
        <h5>Registro de Archivo</h5>
        <div class="row">
            <div class="col-md-4">

                <input type="text" value="{{$id_carpeta}}">

                <label for="nombre">Nombre de Archivo</label>
                <input type="text" name="nombre_Archivo" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label for="archivo">Seleccione el archivo</label>
                <input type="file" name="archivo" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label for="numero_documento">Número Documento</label>
                <input type="number" name="numero_documento" class="form-control form-control-sm">            
            </div>

            <div class="col-md-2">
                <label for="numero_resolucion">Número Resolución</label>
                <input type="number" name="numero_resolucion" class="form-control form-control-sm">
        
            </div>
            <div class="col-md-2">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" class="form-control form-control-sm">
            </div>

            <div class="col-md-4">
                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" class="form-control form-control-sm">
            </div>

        </div>

        <br>
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
    </form>
    <br>
    {{-- Tabla --}}
    <h5>Listado de Archivos</h5>
    <table class="table table-responsive table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre Archivo</th>
                <th>Número Documento</th>
                <th>Número Resolución</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivos as $archivo)
                <tr>
                    <td>{{ $archivo->id }}</td>
                    <td>{{ $archivo->nombre_archivo }}</td>
                    <td>{{ $archivo->numero_documento }}</td>
                    <td>{{ $archivo->numero_resolucion }}</td>
                    <td>{{ $archivo->nombres }}</td>
                    <td>{{ $archivo->apellidos }}</td>
                    <td>{{ $archivo->tipo }}</td>
                    <td>
                        <a href="{{route('archivo.edit',$archivo->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{route('archivo.destroy',$archivo->id)}}" class="btn btn-danger btn-sm">Eliminar</a>
                        </form>
                    </td>
                </tr>  
            @endforeach
        </tbody>
        
    </table>


@endsection