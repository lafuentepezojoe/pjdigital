@extends('panel.base')
@section('contenido')



@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- @if(isset($notificaciones) && $notificaciones->isNotEmpty()) --}}
    {{-- Mostrar las notificaciones --}}
    {{-- <h3>Notificaciones</h3>
    @foreach ($notificaciones as $notificacion)
        <div class="alert {{ $notificacion->estado == 1 ? 'alert-success' : 'alert-danger' }}">
            Tu solicitud con ID {{ $notificacion->id }} ha sido 
            {{ $notificacion->estado == 1 ? 'aprobada' : 'rechazada' }}.
        </div>
    @endforeach
@else
    <p>No hay notificaciones nuevas.</p>
@endif
 --}}

<div id="perfil" class="container mt-5">
    <h2 class="text-center mb-4" style="color: #28a745; font-weight: bold;">Listado de Solicitudes</h2>
    <div class="table-responsive">
    <table class="table table-bordered align-middle" style="background-color: #f9f9f9;">
        <thead class="table-light text-center">
            <tr style="background-color: #d4edda;">
                <th>Id</th>
                <th>Acción</th>
                <th>Id Recurso</th>
                <th>Recurso</th>
                <th>Acción</th>
                <th>Estado</th>
                <th>Usuario Solicita</th>
                <th>Comentario</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $so)
            <tr class="text-center">
                <td>{{ $so->id }}</td>
                <td>
                    @if (auth()->user()->rol === 'admin')
                    <button 
                        @if ($so->estado == '1') 
                        disabled 
                            @endif 
                            onclick="aprobar_solicitud({{ $so->id }})" 
                            class="btn btn-outline-success btn-sm w-100">
                            Aprobar
                        </button>
                        <button 
                        @if ($so->estado == '2') 
                                disabled 
                                @endif 
                                onclick="rechazar_solicitud({{ $so->id }})" 
                                class="btn btn-outline-success btn-sm w-100">
                                Rechazar
                            </button>

                    @else
                    <span class="badge bg-warning ">No autorizado</span>
                            
                    @endif
                </td>
                <td>{{ $so->id_recurso }}</td>
                <td>{{ $so->recurso }}</td>
                <td>{{ $so->accion }}</td>
                <td>
                    @if($so->estado == '0') 
                        <span class="badge bg-warning ">Pendiente</span>
                        
                    @endif
                    @if($so->estado == '1') 
                        <span class="badge bg-success ">Aprobada</span>
                        
                    @endif
                    @if($so->estado == '2') 
                        <span class="badge bg-danger ">Rechazada</span>
                    @endif

                        
                        
                    
                </td>
                <td>{{ $so->user->name }}</td>
                <td>{{ $so->comentario }}</td>
                <td>{{ $so->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="pagination-container justify-content-center mt-3">
        {{ $solicitudes->links('pagination::bootstrap-5') }}
    </div>
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
    
</div>

{{-- Modal de confirmación Aprobar--}}
<div class="modal fade" id="modalAprobarSolicitud" tabindex="-2 " aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #28a745;">
    <h5 class="modal-title" id="modalLabel" style="color: white;">Confirmar Aprobación</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
    <p>¿Estás seguro de que deseas aprobar esta solicitud?</p>
        </div>
        <div class="modal-footer justify-content-center">
            <form action="{{ route('solicitudes.aprobar') }}" method="POST">
                @csrf
                <input type="hidden" name="id_solicitud" id="id_solicitud">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </form>
        </div>
    </div>
    </div>
</div>

{{-- Modal de confirmación Rechazar--}}
<div class="modal fade" id="modalRechazarSolicitud" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #28a745;">
    <h5 class="modal-title" id="modalLabel" style="color: white;">Rechazar Solicitud</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
    <p>¿Estás seguro de que deseas rechazar esta solicitud?</p>
        </div>
        <div class="modal-footer justify-content-center">
            <form action="{{ route('solicitudes.rechazar') }}" method="POST">
                @csrf
                <input type="hidden" name="id_solicitud_rech" id="id_solicitud_rech">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Confirmar</button>
            </form>
        </div>
    </div>
    </div>
</div>

<script>
    function aprobar_solicitud(id) {
        $('#modalAprobarSolicitud').modal('show');
        $('#id_solicitud').val(id);
    }
</script>

<script>
    function rechazar_solicitud(id) {
        $('#modalRechazarSolicitud').modal('show');
        $('#id_solicitud_rech').val(id);
    }
</script>

<style>
    /* Estilos adicionales para mejorar apariencia */
    .table-bordered {
        border: 1px solid #e0e0e0;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #e0e0e0;
    }

    .table-hover tbody tr:hover {
        background-color: #e9f5e9;
    }

    .btn-outline-success {
        border-color: #28a745;
        color: #28a745;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
    }

    .modal-header {
        color: white;
    }
</style>

@endsection
