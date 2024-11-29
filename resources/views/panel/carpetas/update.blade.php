@extends('panel.base')
@section('contenido')
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{route('carpeta.update')}}" method="POST">@csrf
        <h5>Formulario Editar Carpeta</h5>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="carpeta_id" value="{{$carpeta->id}}" class="form-control form-control-sm" hidden>

                <label for="nombre">Nombre de Carpeta</label>
                <input type="text" name="nombre" value="{{$carpeta->nombre}}" class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label for="sede">Sede</label>
                <input type="text" name="sede" value="{{$carpeta->sede}}" class="form-control form-control-sm">            
            </div>

            <div class="col-md-2">
                <label for="numero_almacen">Número Ambiente</label>
                <input type="number" name="numero_almacen" value="{{$carpeta->numero_almacen}}" class="form-control form-control-sm">
        
            </div>
            <div class="col-md-2">
                <label for="numero_estante">Número Estante</label>
                <input type="number" name="numero_estante" value="{{$carpeta->numero_estante}}" class="form-control form-control-sm">
            </div>
            <div class="col-md-2">
                <label for="seccion" class="form-label">Seccion</label>
                <input type="text" name="seccion" value="{{$carpeta->seccion}}" class="form-control form-control-sm" placeholder="A, B, C" required>
            </div>

            <div class="col-md-4">
                <label for="anho">Año</label>
                <input type="number" name="anho" value="{{$carpeta->anho}}" class="form-control form-control-sm">
            </div>

        </div>

        <br>
        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
    </form>
    <br>


@endsection