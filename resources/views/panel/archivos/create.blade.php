@extends('panel.base')
@section('contenido')
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (auth()->user()->rol === 'admin' or auth()->user()->rol === 'asisente')
        
    
    <form action="{{route('archivo.store', $carpeta->id)}}" method="POST" enctype="multipart/form-data" >@csrf
        <h5>Registro de Archivo</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="">Carpeta</label>
                <input class="form-control form-control-sm" type="text" value="{{$carpeta->id}}-{{$carpeta->nombre}}-{{$carpeta->sede}}" readonly style="background-color: rgb(211, 208, 208)">

                <label for="nombre_archivo">Nombre de Archivo</label>
                <input type="text" name="nombre_archivo" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-4">
                <label for="archivo">Seleccione el archivo</label>
                <input type="file" name="archivo" class="form-control form-control-sm" accept="application/pdf" required >
            </div>
            <div class="col-md-2">
                <label for="numero_documento">Número Documento</label>
                <input type="number" name="numero_documento" class="form-control form-control-sm" required>
            </div>
            
            <div class="col-md-2">
                <label for="numero_resolucion">Número Resolución</label>
                <input type="number" name="numero_resolucion" class="form-control form-control-sm" required>
        
            </div>
            <div class="col-md-2">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" class="form-control form-control-sm" required>
            </div>
            
            <div class="col-md-4">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-2">
                <label for="dni">Dni</label>
                <input type="text" name="dni" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-2">
                <label for="tipo">Tipo</label>
                <input type="text" name="tipo" class="form-control form-control-sm" required>
            </div>
            
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
    </form>
    @endif
    <br>
    {{-- Tabla --}}
    <h5 class="text-center text-success  mb-3">Listado de Archivos</h5>
    <div class="table-responsive">
    <table class="table table-bordered table-stripe text-center table-green">
        <thead class="table-light-green">
            <tr>
                <th>N°</th>
                <th>Nombre Archivo</th>
                <th>Archivo</th>
                <th>Número Documento</th>
                <th>Número Resolución</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Dni</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivos as $archivo)
                <tr>
                    <td>{{ $archivo->id }}</td>
                    <td>{{ $archivo->nombre_archivo }}</td>
                    <td>
                        
                        {{-- @if(Str::endsWith($archivo->archivo, ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Si el archivo es una imagen, lo mostramos con una etiqueta <img> -->
                            <h5>Vista previa de la imagen:</h5>
                            
                            <img src="{{ asset('storage/archivos/' . $archivo->archivo) }}" alt="{{ $archivo->nombre_archivo }}" style="max-width: 200px;">
                            <a href="{{ asset('storage/archivos/' . $archivo->archivo) }}" download>{{ $archivo->nombre_archivo }} </a>
                        @else --}}
                            <!-- Si no es una imagen, mostramos un enlace para descargar -->
                            
                            {{-- <a href="{{ asset('storage/archivos/' . $archivo->archivo) }}" download>{{ $archivo->nombre_archivo }}</a> --}}
                            <a target="_blank" href="{{ asset('storage/archivos/' . $archivo->archivo) }}" class="btn btn-info btn-sm"><i class="bi bi-eye">Ver archivo</i></a>
                        {{--                             
                        @endif --}}


                    </td>
                    <td>{{ $archivo->numero_documento }}</td>
                    <td>{{ $archivo->numero_resolucion }}</td>
                    <td>{{ $archivo->nombres }}</td>
                    <td>{{ $archivo->apellidos }}</td>
                    <td>{{ $archivo->dni }}</td>
                    <td>{{ $archivo->tipo }}</td>
                    <td>
                        @if (auth()->user()->rol === 'admin')
                            <a href="{{route('archivo.edit',$archivo->id)}}" class="btn btn-warning btn-sm">Editar</a>
                            <a onclick="eliminar_archivo({{$archivo->id}})" class="btn btn-danger btn-sm">Eliminar</a>
                        @endif

                        @if (auth()->user()->rol == 'asistente' && $archivo->accion=='editar' && $archivo->estado==1)
                        <a href="{{route('archivo.edit',$archivo->id)}}" class="btn btn-warning btn-sm">Editar</a>
                        @endif
                        @if (auth()->user()->rol == 'asistente' && $archivo->accion=='eliminar' && $archivo->estado==1)
                        <a onclick="eliminar_archivo({{$archivo->id}})" class="btn btn-danger btn-sm">Eliminar</a>
                        @endif

                        </form>
                    </td>
                </tr>  
            @endforeach
        </tbody>
        
    </table>
    

        
    <div class="pagination-container justify-content-center mt-3">
        {{ $archivos->links('pagination::bootstrap-5') }}
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
    

    {{-- href="{{route('archivo.destroy',$archivo->id)}}" --}}
    
    {{-- Modal --}}
    <div class="modal" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Deseas eliminar?.</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('archivo.destroy')}}" method="POST">@csrf
                    <input type="text" name="id_archivo_eliminar" id="id_archivo_eliminar" hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Sí</button>
                </form>
            </div>
          </div>
        </div>
      </div>


    <script>
        function eliminar_archivo(id) {
            $("#id_archivo_eliminar").val(id)
            $("#modalEliminar").modal('show');
        }
    </script>

@endsection