<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Archivo Central</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome para Iconos -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  {{-- <link rel="stylesheet" href="../../js/style.css"> --}}
  
<style>
    #notificationMessage {
      position: absolute; /* Para que el globo no afecte el flujo del contenido */
      top: 100%; /* Aparece debajo del ícono de la campana */
      left: 50%;
      transform: translateX(-50%);
      z-index: 1050; /* Asegura que el globo esté por encima de otros elementos */
      width: auto; /* Ajusta el tamaño automáticamente según el contenido */
      max-width: 300px; /* Limita el ancho máximo */
    }
</style>


  
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
      min-height: 80vh;
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
  <nav class="navbar navbar-expand-lg bg-fuxion navbar-dark p-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Archivo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Inicio</a>
          </li>
        </ul>
        <div class="d-flex align-items-center">
          <!-- Formulario de búsqueda -->
          <form class="d-flex search-form" role="search" action="{{route('profesor.buscar')}}" method="POST">@csrf
            <input class="form-control me-2" name="nombres" type="search" placeholder="Ingrese nombre para buscar" aria-label="Buscar">

            <button class="btn btn-success" type="submit">Buscar</button>
          </form>
            
          @if (auth()->user()->rol === 'admin')
            <a href="{{route('solicitudes.index')}}">
            <div class="notification-icon ms-3 position-relative">
              <i class="fas fa-bell fa-lg"></i>
              <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                  {{ $solicitudesCount ?? 0 }}
                </span>
            </div>
            </a>
          @endif
          @if (auth()->user()->rol === 'asistente')
            
            <div class="notification-container position-relative ms-3">
              <div class="notification-icon position-relative" id="notificationBell" style="cursor: pointer;">
                  <i class="fas fa-bell fa-lg text-primary"></i>
                  <span class="badge bg-danger position-absolute top-0 start-100 translate-middle shadow-sm">
                      {{ $solicitudesCountAsistente ?? 0 }}
                  </span>
              </div>
              <a href="">
                
                <div id="notificationMessage" class="alert alert-info d-none notification-alert mt-2 shadow-sm" role="alert">
                  Tienes mensajes de las solicitudes
                </div>
              </a>
          </div>
        
          @endif

          @yield('solicitudes')
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

  <div class="row m-0" >
    <div class="col-md-3">
      <div class="sidebar">
        <div class="row g-0">
          <!-- Columna pegada a la izquierda que se extiende hacia abajo -->
          <div class="col-12 d-flex flex-column align-items-start justify-content-start p-4 sidebar-menu">
            <!-- Botón para crear carpetas con nuevo estilo en blanco y negro -->
            <a href="{{route('dashboard')}}"
              class="btn w-70 mb-2 d-flex align-items-center menu-link">
                <i class="fas fa-tachometer-alt me-2"></i> <span>Dashboard</span>
            </a>
            
              <a href="{{ route('carpeta.create') }}" 
              class="btn w-70 mb-2 btn-crear-carpeta d-flex align-items-center">
                <i class="fas fa-folder-plus me-2"></i><span>Crear Carpeta</span>
              </a>
            
            
            <!-- Links del menú con animación -->
            <a href="{{route('solicitudes.carpetayarchivos')}}" 
              class="btn w-70 mb-2 d-flex align-items-center menu-link">
                <i class="fas fa-folder-open me-2"></i> <span>Carpetas y Archivos</span>
            </a>
            @if (auth()->user()->rol === 'admin' or auth()->user()->rol === 'secretario' )
              <a href="{{route('solicitudes.index')}}" 
                class="btn w-70 mb-2 d-flex align-items-center menu-link">
                  <i class="fas fa-envelope-open-text me-2"></i> <span>Solicitudes</span>
              </a>
            
              <a href="{{route('usuarios.index')}}" 
                class="btn w-70 mb-2 d-flex align-items-center menu-link">
                  <i class="fas fa-user me-2"></i> <span>Perfil</span>
              </a>
            @endif
          </div>
        </div>
      </div>

  <style>
    .notification-container {
    display: inline-block;
    text-align: center;
    position: relative;
    z-index: 1000;
}

.notification-icon {
    position: relative;
    width: 25px;
    /* height: 50px; */
    /* background: radial-gradient(circle at 50% 50%, #FFC107, #FF9800); */
    border-radius: 25%;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.notification-icon:hover {
    transform: scale(1.2) rotate(15deg);
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.3);
}

.notification-bell {
    font-size: 2rem;
    color: #fff;
    animation: ring 2s infinite;
}

@keyframes ring {
    0%, 100% {
        transform: rotate(0);
    }
    10%, 30%, 50%, 70% {
        transform: rotate(-15deg);
    }
    10%, 20%, 40% {
        transform: rotate(15deg);
    }
}

.badge {
    font-size: 0.9rem;
    font-weight: bold;
    /* border-radius: 50%; */
    padding: 0.4rem;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    transform: scale(1);
    /* animation: pop 0.8s ease-in-out infinite; */
}

@keyframes pop {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
}

.notification-alert {
    border: 2px dashed #007BFF;
    animation: slideIn 0.5s ease-in-out;
    font-size: 1rem;
    text-align: center;
    background: linear-gradient(135deg, #D4E6F1, #AED6F1);
    color: #0056b3;
    font-weight: bold;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

  </style>
  
  <style>
  /* Estilos de la sidebar */
  .sidebar-menu {
    background-color: #fff;
    width: 100%;
    padding: 10px;
  }

  /* Estilos unificados para todos los botones del menú */
  .menu-link, .btn-crear-carpeta {
    padding: 10px 16px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(45deg, #34a853, #0d47a1);
    border: none;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px; /* Espacio entre botones */
  }

  /* Efecto de hover */
  .menu-link:hover, .btn-crear-carpeta:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #0d47a1, #34a853);
  }

  /* Efecto al hacer clic */
  .menu-link:active, .btn-crear-carpeta:active {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    background: linear-gradient(45deg, #34a853, #1b5e20);
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
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  {{-- <script src="../../modal/jquery.js"></script> --}}

<script>
    $('#notificationBell').on('click', function (e) {
      e.preventDefault();

      // Mostrar el globo de mensaje
      const $notificationMessage = $('#notificationMessage');
      //aqui llama al ajax
      var texto_mensaje="";
      var num = 0
      recibir_notificacion()
      .then((datos) => {
        if (Array.isArray(datos) && datos.length > 0) {
          datos.forEach(element => {
            num+=1
            texto_mensaje = texto_mensaje + " N° "+ num + " ."+ element.id_recurso +" " + element.recurso + " " + element.accion
          });

          $notificationMessage.removeClass('d-none').text("Respuesta de Solicitudes:"+ texto_mensaje);

        } else {
          $notificationMessage.removeClass('d-none').text('¡Todos los mensaje leídos!');
        }
      })
      .catch((error) => {
        console.error("Error al obtener notificaciones:", error);
      });

      // Ocultar el globo después de 9 segundos
      setTimeout(function () {
          $notificationMessage.addClass('d-none');
      }, 9000);

      
  });

    
    $('#notificationMessage').on('click', function (e) {
      // Realizar la solicitud AJAX para actualizar la columna 'leido'
      $.ajax({
          url: '/marcar-leido',
          type: 'get',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
              location.reload();
              // console.log('Notificaciones actualizadas.');

          },
          error: function (xhr, status, error) {
            alert('Error al actualizar las notificaciones:', error);
              console.error('Error al actualizar las notificaciones:', error);
          }
      });
    });

  function recibir_notificacion() {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "GET",
      url: "/solicitudes/notificaciones",
      dataType: "json",
      success: function (response) {
        resolve(response); // Resuelve la promesa con los datos obtenidos
      },
      error: function (xhr, status, error) {
        reject(error); // Rechaza la promesa si ocurre un error
      }
    });
  });
}



</script>

</body>
</html>

