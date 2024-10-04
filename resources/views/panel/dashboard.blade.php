@extends('panel.base')

@section('contenido')
<div class="sidebar">
    <div class="row g-0">
        <!-- Columna pegada a la izquierda que se extiende hacia abajo -->
        <div class="col-12 col-md-2 d-flex flex-column align-items-start justify-content-start p-4" 
            style="border-right: 1px solid #333; height: 100vh; background-color: #fff;">
            <!-- Botón para crear carpetas con nuevo estilo en blanco y negro -->
            <a href="{{ route('carpeta.create') }}" 
            class="btn w-100 mb-3 btn-crear-carpeta" 
            style="padding: 10px 16px; font-size: 14px; font-weight: bold; background-color: #fff; color: #000; 
            border: 1px solid #333; border-radius: 6px;">
                Crear Carpeta
            </a>
            
            <!-- Links del menú con animación -->
            <a href="#dashboard" 
            class="text-dark mb-2 d-flex align-items-center menu-link" 
            style="font-size: 14px; font-weight: bold;">
                <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
            </a>
            <a href="#configuracion" 
            class="text-dark mb-2 d-flex align-items-center menu-link" 
            style="font-size: 14px; font-weight: bold;">
                <i class="fas fa-cogs me-2"></i> <span>Configuración</span>
            </a>
            <a href="#perfil" 
            class="text-dark mb-2 d-flex align-items-center menu-link" 
            style="font-size: 14px; font-weight: bold;">
                <i class="fas fa-user me-2"></i> <span>Perfil</span>
            </a> 
        </div>
    </div>
</div>

<style>
    /* Estilos adicionales */
    .menu-link {
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .menu-link:hover {
        color: #28a745; /* Color verde al pasar el cursor */
    }

    .menu-link:active {
        transform: scale(1.1); /* Animación de escala al hacer clic */
        color: #5cb85c; /* Color verde más claro al hacer clic */
    }

    .btn-crear-carpeta {
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-crear-carpeta:hover {
        background-color: #e0f7fa; /* Color claro al pasar el cursor */
    }

    .btn-crear-carpeta:active {
        transform: scale(1.05); /* Animación de escala al hacer clic */
        background-color: #c8e6c9; /* Color verde claro al hacer clic */
    }
</style>
@endsection
