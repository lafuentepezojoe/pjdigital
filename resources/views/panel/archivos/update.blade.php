@extends('panel.base')
@section('contenido')
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{route('archivo.update', $archivo->id)}}" method="POST">@csrf
        <h5>Formulario Editar Archivo</h5>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="archivo_id" value="{{$archivo->id}}" class="form-control form-control-sm" hidden>

                <label for="nombre">Nombre de Archivo</label>
                <input type="text" name="nombre_Archivo" value="{{$archivo->nombre_archivo}}" class="form-control form-control-sm">
            </div>
            
            <div class="col-md-4">
                <label for="archivo">Seleccione el archivo</label>
                <input type="file" name="archivo" value="{{$archivo->numero_resolucion}}" class="form-control form-control-sm">            
            </div>

            <div class="col-md-4">
                <label for="numero_resolucion">Numero Resolucion</label>
                <input type="number" name="numero_resolucion" value="{{$archivo->numero_resolucion}}" class="form-control form-control-sm">            
            </div>

            <div class="col-md-4">
                <label for="numero_documento">Numero Documento</label>
                <input type="number" name="numero_documento" value="{{$archivo->numero_resolucion}}" class="form-control form-control-sm">            
            </div>

            <div class="col-md-2">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" value="{{$archivo->nombres}}" class="form-control form-control-sm">
        
            </div>
            <div class="col-md-2">
                <label for="apellidos ">Apellidos</label>
                <input type="text" name="apellidos" value="{{$archivo->apellidos}}" class="form-control form-control-sm">
            </div>

            <div class="col-md-4">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" value="{{$archivo->tipo}}" class="form-control form-control-sm">
            </div>

        </div>

        <br>
        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
    </form>
    <br>


@endsection