@extends('panel.base')
@section('contenido')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div id="perfil" class="container mt-5 p-4 shadow-sm rounded" style="background-color: #f5f5f5;">
    <h4 class="text-muted fw-bold mb-4">Gestión de Solicitudes</h4>
    
    <table class="table table-bordered table-hover align-middle text-center" style="background-color: #ffffff;">
        <thead class="text-secondary" style="background-color: #e9ecef;">
            <tr>
                <th>ID</th>
                <th>Nombre de Carpeta</th>
                <th>Sede</th>
                <th>Almacén</th>
                <th>N°Estante</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carpetas as $carpeta)
                <tr>
                    <td>{{ $carpeta->id }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="../../img/carpeta.png" style="width: 35px; margin-right: 10px;" alt="carpeta">
                            <span>{{ $carpeta->nombre }}</span>
                            @if (auth()->user()->rol === 'admin' or auth()->user()->rol === 'asistente')
                                <button onclick="solicitud({{ $carpeta->id }}, 'carpeta', 'eliminar')" class="btn btn-sm mx-1" style="color: #dc3545;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button onclick="solicitud({{ $carpeta->id }}, 'carpeta', 'editar')" class="btn btn-sm mx-1" style="color: #007bff;">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                        </div>
                        <div class="mt-2 ms-5">
                            @foreach ($archivos as $archivo)
                                @if ($archivo && $carpeta->id === $archivo->carpeta_id)
                                    <div class="d-flex align-items-center">
                                        <img src="../../img/documentos.png" style="width: 25px; margin-right: 8px;" alt="documentos">
                                        <span>{{ $archivo->nombres }}</span>
                                        @if (auth()->user()->rol === 'admin' or auth()->user()->rol === 'asistente')
                                            <button onclick="solicitud({{ $archivo->id }}, 'archivo', 'eliminar')" class="btn btn-sm mx-1" style="color: #dc3545;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <button onclick="solicitud({{ $archivo->id }}, 'archivo', 'editar')" class="btn btn-sm mx-1" style="color: #007bff;">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                    <td>{{ $carpeta->sede }}</td>
                    <td>{{ $carpeta->numero_almacen }}</td>
                    <td>{{ $carpeta->numero_estante }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container justify-content-center mt-3">
        {{ $carpetas->links('pagination::bootstrap-5') }}
    </div>
    
    <style>
        /* Estilos personalizados para la paginación */
        .pagination-container {
            padding: 10px;
            border-radius: 10px;
            background-color: #f8f9fa; /* Fondo claro */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        /* Estilos para los botones de paginación */
        .page-item .page-link {
            color: #28a745; /* Verde principal */
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
        }
    
        .page-item.active .page-link {
            color: white;
            background-color: #28a745; /* Fondo verde para el botón activo */
            border-radius: 6px;
        }
    
        .page-item .page-link:hover {
            background-color: #d4edda; /* Verde claro en hover */
            color: #28a745;
            border-radius: 6px;
        }
    </style>
    

    {{-- Modal --}}
    <div class="modal fade" id="modalSolicitud" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #28a745;">
                    <h5 class="modal-title">Confirmar Solicitud</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('solicitudes.store') }}" method="POST">
                        @csrf
                        <label for="comentario" class="form-label">Ingrese un comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_recurso" id="id_recurso">
                    <input type="hidden" name="recurso" id="recurso">
                    <input type="hidden" name="accion" id="accion">
                    <p class="text-muted">¿Deseas registrar la solicitud?</p>
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success">Sí</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function solicitud(id, recurso, accion) {
        $("#id_recurso").val(id);
        $("#recurso").val(recurso);
        $("#accion").val(accion);
        $("#modalSolicitud").modal('show');
    }
</script>

@endsection
