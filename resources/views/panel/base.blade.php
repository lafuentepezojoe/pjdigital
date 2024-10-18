<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Archiv Central</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome para Iconos -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    /* Estilo General */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f9; /* Fondo claro */
      margin: 0;
      padding: 0;
    }

    /* Navbar con colores verde */
    .bg-fuxion {
      background-color: #28a745; /* Verde */
    }

    .navbar {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      color: #fff; /* Blanco para el texto */
      font-size: 1.8rem;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .navbar-brand:hover {
      color: #e0f7fa; /* Cambio de color al pasar el cursor */
    }

    /* Icono de menú de hamburguesa */
    .navbar-toggler {
      border: none;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255,255,255, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E"); /* Icono blanco */
    }

    /* Estilos para el formulario de búsqueda */
    .search-form {
      margin-left: 20px;
    }

    .search-form .form-control {
      border-color: #fff; /* Borde blanco */
      background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
      color: #333; /* Texto oscuro */
      border-radius: 30px; /* Bordes redondeados */
      padding-left: 20px; /* Espaciado interno */
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .search-form .form-control::placeholder {
      color: #999; /* Placeholder gris */
    }

    .search-form .form-control:focus {
      border-color: #28a745; /* Borde verde al enfocarse */
      box-shadow: 0 0 10px rgba(40, 167, 69, 0.25); /* Sombra suave */
      background-color: rgba(255, 255, 255, 1); /* Fondo blanco al enfocar */
    }

    .search-form .btn-success {
      background-color: #28a745; /* Verde */
      border-color: #28a745;
      color: #fff;
      border-radius: 50px;
      padding: 8px 20px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .search-form .btn-success:hover {
      background-color: #1e7e34; /* Verde más oscuro en hover */
      border-color: #1e7e34;
      transform: scale(1.05);
    }

    /* Estilos para el logo de usuario y dropdown */
    .user-info {
      display: flex;
      align-items: center;
      color: #fff;
      margin-left: auto;
      position: relative;
    }

    .user-info .user-initial {
      background-color: #fff; /* Blanco */
      color: #28a745; /* Verde para el texto */
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      margin-right: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .user-info .user-initial:hover {
      background-color: #28a745; /* Verde al pasar el cursor */
      color: #fff;
      transform: scale(1.1);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    .user-info p {
      margin: 0;
      color: #fff;
      font-weight: bold;
    }

    /* Dropdown personalizado sin flechita */
    .dropdown-menu {
      background-color: #28a745;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      min-width: 150px;
      padding: 10px 0;
    }

    /* Eliminar la flechita del dropdown */
    .dropdown-toggle::after {
      display: none;
    }

    .dropdown-item {
      color: #fff;
      transition: background-color 0.3s ease, color 0.3s ease;
      padding: 10px 20px;
      text-decoration: none;
      display: block;
    }

    .dropdown-item:hover {
      background-color: #1e7e34; /* Verde más oscuro en hover */
      color: #fff;
    }

    /* Botón Cerrar Sesión */
    .btn-cerrar-sesion {
      background-color: transparent;
      color: #fff;
      border: none;
      width: 100%;
      text-align: left;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
    }

    .btn-cerrar-sesion:hover {
      background-color: rgba(255, 255, 255, 0.2); /* Fondo semi-transparente en hover */
    }

    /* Contenido Principal */
    .content {
      margin-left: 0; /* Alineado a la izquierda */
      padding: 20px;
      background-color: white; /* Fondo blanco */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      min-height: 100vh;
      transition: all 0.3s;
    }

    /* Estilos del Dashboard */
    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .dashboard-header h2 {
      margin: 0;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-icon {
      font-size: 2rem;
      color: #28a745;
    }

    .select-option {
      width: 150px;
    }

    /* Responsividad para la barra de búsqueda y usuario */
    @media (max-width: 992px) {
      .search-form {
        width: 100%;
        margin-top: 10px;
      }

      .user-info {
        flex-direction: column;
        align-items: flex-end;
      }

      .user-info p {
        margin-left: 0;
        margin-top: 5px;
      }
    }
  </style>
</head>
<body>
  
  <!-- Navbar Superior -->
  <nav class="navbar navbar-expand-lg bg-fuxion navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Archivo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
        </ul>
        <div class="d-flex align-items-center">
          <!-- Formulario de búsqueda -->
          <form class="d-flex search-form" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-success" type="submit">Buscar</button>
          </form>
          
          <!-- Información del usuario y dropdown -->
          <div class="user-info dropdown ms-3">
            @auth
              <div class="user-initial dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </div>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item btn-cerrar-sesion">Cerrar sesión</button>
                  </form>
                </li>
              </ul>
              <p>{{ Auth::user()->name }}</p>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="row">
    <div class="col-md-3">
      <div class="sidebar">
        <div class="row g-0">
          <!-- Columna pegada a la izquierda que se extiende hacia abajo -->
          <div class="col-12 d-flex flex-column align-items-start justify-content-start p-4 sidebar-menu" style="height: 100vh;">
            <!-- Botón para crear carpetas con nuevo estilo en blanco y negro -->
            <a href="{{ route('carpeta.create') }}" 
              class="btn w-100 mb-3 btn-crear-carpeta">
                Crear Carpeta
            </a>
            
            <!-- Links del menú con animación -->
            <a href="#dashboard" 
              class="text-dark mb-2 d-flex align-items-center menu-link">
                <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
            </a>
            <a href="#configuracion" 
              class="text-dark mb-2 d-flex align-items-center menu-link">
                <i class="fas fa-cogs me-2"></i> <span>Configuración</span>
            </a>
            <a href="{{route('usuarios.index')}}" 
              class="text-dark mb-2 d-flex align-items-center menu-link">
                <i class="fas fa-user me-2"></i> <span>Perfil</span>
            </a>
          </div>
        </div>
      </div>
  
      <style>
        /* Estilos de la sidebar */
        .sidebar-menu {
          border-right: 1px solid #333;
          background-color: #fff;
          width: 100%;
        }
  
        /* Estilos del menú */
        .menu-link {
        font-size: 14px;
        font-weight: bold;
        display: flex;
        align-items: center;
        transition: color 0.3s ease, transform 0.3s ease;
        padding: 10px 16px;
        color: #000;
        border-radius: 6px;
        }
  
        .menu-link:hover {
          color: #28a745; /* Color verde al pasar el cursor */
        }
  
        .menu-link:active {
          transform: scale(1.1); /* Animación de escala al hacer clic */
          color: #5cb85c; /* Color verde más claro al hacer clic */
        }
  
        /* Estilos del botón de crear carpeta */
        .btn-crear-carpeta {
          padding: 10px 16px;
          font-size: 14px;
          font-weight: bold;
          background-color: #fff;
          color: #000;
          border: 1px solid #333;
          border-radius: 6px;
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
    </div>
  
    <div class="col-md-9">
      <div class="container-fluid">
        <div class="content mt-4">
          @yield('contenido')
        </div>
      </div>
    </div>
  </div>
  


  <!-- Contenido Principal -->
  
  <!-- JS de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FontAwesome JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>

