@extends('panel.base')
@section('contenido')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Nuevo contenido dentro del perfil -->
<div id="perfil" class="container mt-4">
    <div class="text-center mb-4">
        <h3 class="text-success mb-4">Administrar Usuarios</h3>
    </div>
    
    @if (auth()->user()->rol === 'admin')
        
        <!-- Contenedor para el botón de creación y la tabla -->
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">
                <i class="bi bi-plus-circle"></i> Crear Usuario
            </button>
        </div>
    @endif

    <!-- Tabla para mostrar los usuarios existentes -->
    <div class="table-responsive">
        <table class="table table-bordered table-stripe text-center">
            <thead style="background-color: #27ae60; color: white;">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->apellidos }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->direccion }}</td>
                    <td>{{ ucfirst($usuario->rol) }}</td>
                    <td>
                        <span class="badge {{ $usuario->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $usuario->status ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        @if (auth()->user()->rol === 'admin')
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                            <a onclick="reset_password({{ $usuario->id }})" class="btn btn-primary btn-sm">
                                <i class="bi bi-lock"></i> Resetear
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para crear un nuevo usuario -->
    <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="col-md-6">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rol" class="form-label">Rol</label>
                                <select name="rol" class="form-select" required>
                                    <option value="admin">Admin</option>
                                    <option value="asistente">Asistente</option>
                                    <option value="asistente">Secretario</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-3 w-100 shadow-sm">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal del formulario para la contraseña -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="resetPasswordModalLabel">Resetear Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios.resetPassword') }}" method="POST">
                    @csrf
                    <div class="col-md-2">
                        <label for="id_usuario" class="form-label">Usuario ID</label>
                        <input type="text" id="id_usuario" name="id_usuario" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100 shadow-sm">Resetear Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function reset_password(id_usuario) {
        $("#id_usuario").val(id_usuario);
        $("#resetPasswordModal").modal("show");
    }
</script>

@endsection


