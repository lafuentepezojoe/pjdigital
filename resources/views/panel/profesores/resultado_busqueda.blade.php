@extends('panel.base')

@section('contenido')

<style>
    /* Estilo general para la tabla */
    .table-container {
        background-color: #f7f7f7;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h5 {
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
    }

    /* Estilos para los encabezados de la tabla */
    .table thead th {
        background-color: #f5f5f5;
        color: #333;
        text-align: center;
        font-weight: bold;
        border: 1px solid #ddd;
        padding: 12px;
        font-size: 14px;
        text-transform: uppercase;
    }

    /* Estilos para las celdas de la tabla */
    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 12px 10px;
        border: 1px solid #ddd;
        font-size: 13px;
        color: #555;
    }

    /* Colores para los enlaces */
    .btn-info {
        background-color: #17a2b8;
        border: none;
        color: white;
        padding: 8px 20px;
        font-size: 13px;
        font-weight: bold;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    /* Estilo para las filas al pasar el cursor */
    .table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Estilo de la sangría */
    .sangria1 {
        padding-left: 15px;
        font-style: italic;
        color: #6c757d;
    }

    /* Estilo para las celdas de las carpetas */
    .folder-cell {
        font-weight: bold;
        color: #333;
    }
</style>

<div class="container mt-4 table-container">
    <h5 class="text-center text-success  mb-3">Resultados de la Búsqueda</h5>
    <div class="table-responsive">
    <table class="table table-bordered table-stripe text-center">
        <thead>
            <tr>
                <th>Carpeta</th>
                <th>Nombre Archivo</th>
                <th>N° Documento</th>
                <th>N° Resolución</th>
                <th>Nombre Completo</th>
                <th>Dni</th>
                <th>Tipo</th>
                <th>Archivo</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $r)
            <tr>
                <td class="folder-cell">
                    {{ $r->nombre_carpeta }}
                    <br>
                    <i class="sangria1">Ambiente:</i>
                    <span class="sangria1">{{ $r->numero_almacen }}</span><br>
                    <i class="sangria1">Estante:</i>
                    <span class="sangria1">{{ $r->numero_estante }}</span><br>
                    <i class="sangria1">Sección:</i>
                    <span class="sangria1">{{ $r->seccion }}</span>
                </td>
                <td>{{ $r->nombre_archivo }}</td>
                <td>{{ $r->numero_documento }}</td>
                <td>{{ $r->numero_resolucion }}</td>
                <td>{{ $r->nombres }} {{ $r->apellidos }}</td>
                <td>{{$r->dni}}</td>
                <td>{{ $r->tipo }}</td>
                <td>
                    <a target="_blank" href="{{ asset('storage/archivos/' . $r->archivo) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye"></i> Ver archivo
                    </a>
                </td>
                <td>{{ $r->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>


    
    {{-- <div class="d-flex justify-content-center">
        {{ $resultados->links('pagination::bootstrap-5') }}
    </div> --}}
    

{{-- 
    @foreach ($resultados as $item)
        <h5>{{$item->numero_resolucion}}</h5>
        <h5>{{$item->numero_documento}}</h5>
        <h5>{{$item->nombre_archivo}}</h5>
    @endforeach --}}

    {{-- @if($resultados->isEmpty())
        <p>No se encontraron resultados para "{{ $resultados }}"</p>
    @else
        @foreach ($resultados as $resul)
            <h5>{{ $resul->numero_documento }}</h5>
            <h5>{{ $resul->numero_resolucion }}</h5>
        @endforeach
    @endif --}}
@endsection