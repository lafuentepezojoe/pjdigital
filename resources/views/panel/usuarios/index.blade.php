@extends('panel.base')
@section('contenido')

            <!-- Nuevo contenido dentro del perfil -->
            <div id="perfil" class="container mt-4">
                <h3>Administrar Usuarios</h3>
                
                <!-- Botón para abrir el formulario de creación de usuarios -->
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearUsuarioModal">Crear Usuario</button>

                <!-- Tabla para mostrar los usuarios existentes -->
                <table class="table table-bordered">
                    <thead>
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
                            <td>{{ $usuario->rol }}</td>
                            <td>{{ $usuario->status }}</td>
                            <td>
                                <!-- Botones de acción para editar/eliminar usuarios -->
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>

                                </form>

                                <!-- boton para resetear la contraseña -->
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">Resetear</a>

                                <!-- Modal del formulario para la contraseña -->
                                <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="resetPasswordModalLabel">Resetear Contraseña</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('usuarios.resetPassword', $usuario->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Nueva Contraseña</label>
                                                        <input type="password" name="password" class="form-control" id="password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Resetear Contraseña</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>

                <!-- Modal para crear un nuevo usuario -->
                <div class="modal fade" id="crearUsuarioModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="crearUsuarioModalLabel">Crear Nuevo Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('usuarios.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo</label>
                                        <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control form-control-sm" id="apellidos" name="apellidos" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">telefono</label>
                                        <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">direccion</label>
                                        <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-control form-control-sm" required>
                                            <option value="1">activo</option>
                                            <option value="0">inactivo</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">contraseña</label>
                                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Rol</label>
                                        <select name="rol" class="form-control form-control-sm" required>
                                            <option value="admin">admin</option>
                                            <option value="asistente">asistente</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Crear Usuario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
@endsection


