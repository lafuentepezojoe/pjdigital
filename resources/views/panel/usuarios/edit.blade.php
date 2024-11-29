@extends('panel.base')
@section('contenido')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{route('usuarios.update', $usuario->id)}}" method="POST">@csrf
    <h5>Formulario Editar</h5>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="usuario_id" value="{{$usuario->id}}" class="form-control form-control-sm" hidden>

            <label for="email">Correo</label>
            <input type="email" name="email" value="{{$usuario->email}}" class="form-control form-control-sm">
        </div>
        <div class="col-md-4">
            <label for="nombres">Nombres</label>
            <input type="text" name="name" value="{{$usuario->name}}" class="form-control form-control-sm">            
        </div>

        <div class="col-md-4">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="{{$usuario->apellidos}}" class="form-control form-control-sm">
    
        </div>
        <div class="col-md-2">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" value="{{$usuario->telefono}}" class="form-control form-control-sm">
        </div>

        <div class="col-md-4">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" value="{{$usuario->direccion}}" class="form-control form-control-sm">
        </div>

        <div class="col-md-4">
            <label for="rol">Rol</label>
            <select name="rol" class="form-select" required>
                @if ($usuario->rol=='admin')
                    <option value="admin" selected>Admin</option>
                    <option value="asistente">Asistente</option>
                    <option value="secretario">Secretario</option>    
                @elseif ($usuario->rol=='asistente')
                    <option value="admin">Admin</option>
                    <option value="asistente" selected>Asistente</option>
                    <option value="secretario">Secretario</option>
                @elseif ($usuario->rol=='secretario')
                    <option value="admin">Admin</option>
                    <option value="asistente">Asistente</option>
                    <option value="secretario" selected>Secretario</option>    
                @endif
                
            </select>
        </div>

        <div class="col-md-4">
            <label for="status">Status</label>
            <select name="status" class="form-select" required>
                @if ($usuario->status=='1')
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                @else
                    <option value="1">Activo</option>
                    <option value="0" selected>Inactivo</option>
                @endif

            </select> 
        </div>

    </div>

    <br>
    
    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
</form>
<br>
@endsection