@extends('panel.base')
@section('contenido')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container p-4 bg-light rounded">
@if (auth()->user()->rol === 'admin' or auth()->user()->rol === 'asistente' )
    

<form action="{{ route('carpeta.store') }}" method="POST" class="mb-4">
    @csrf
    <h4 class="text-success mb-4">Registro de Carpeta</h4>
    
    
    <div class="row g-3">
        <div class="col-md-4">
                <label for="nombre" class="form-label">Nombre de Carpeta</label>
                <input type="text" name="nombre" class="form-control form-control-sm" placeholder="Ingresa el nombre">
            </div>
            <div class="col-md-4">
                <label for="sede" class="form-label">Sede</label>
                <input type="text" name="sede" class="form-control form-control-sm" value="Central" readonly>
            </div>
            <div class="col-md-2">
                <label for="numero_almacen" class="form-label">Número de Ambiente</label>
                <select name="numero_almacen" class="form-control form-control-sm">
                    <option value="" selected disabled>Seleccione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="numero_estante" class="form-label">Número Estante</label>
                <input type="number" name="numero_estante" class="form-control form-control-sm" placeholder="N° Estante">
            </div>
                <div class="col-md-2">
                    <label for="seccion" class="form-label">Seccion</label>
                    <select name="seccion" class="form-control form-control-sm">
                        <option value="" selected disabled>Seleccione</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="anho" class="form-label">Año</label>
                    <input type="number" name="anho" class="form-control form-control-sm" placeholder="Año">
                </div>
            </div>
            
            <div class="text mt-4">
                <button type="submit" class="btn btn-success btn-sm px-4">Guardar</button>
            </div>
        </form>
@endif
        
        <h5 class="text-center text-success  mb-3">Listado de Carpetas</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-stripe text-center table-green">
            <thead class="table-light-green">
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Sede</th>
                    <th>Número Ambiente</th>
                    <th>Número Estante</th>
                    <th>Sección</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carpetas as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->sede }}</td>
                        <td>{{ $c->numero_almacen }}</td>
                        <td>{{ $c->numero_estante }}</td>
                        <td>{{ $c->seccion }}</td>
                        <td>{{ $c->anho }}</td>
                        <td>
                            @if (auth()->user()->rol == 'admin')
                                <a href="{{ route('carpeta.edit', $c->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <button onclick="eliminar_carpeta({{ $c->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                            @endif
                            @if (auth()->user()->rol == 'asistente' && $c->accion == 'editar' && $c->estado == 1)
                                <a href="{{ route('carpeta.edit', $c->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            @endif
                            @if (auth()->user()->rol == 'asistente' && $c->accion == 'eliminar' && $c->estado == 1)
                                <button onclick="eliminar_carpeta({{ $c->id }})" class="btn btn-danger btn-sm">Eliminar</button>
                            @endif
                            <a href="{{ route('archivo.create', $c->id) }}" class="btn btn-info btn-sm">Archivos</a>
                        </td>
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
        
    </div>
</div>


    


{{-- Modal --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmación de Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta carpeta?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('carpeta.destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_carpeta_eliminar" id="id_carpeta_eliminar">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Sí</button>
                </form>
            </div>
        </div>
    </div>
    
</div>

<script>
    function eliminar_carpeta(id) {
        document.getElementById("id_carpeta_eliminar").value = id;
        new bootstrap.Modal(document.getElementById("modalEliminar")).show();
    }
</script>

@endsection
