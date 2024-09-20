<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="antialiased">

    <!-- Contenedor principal -->
    <div class="container-fluid p-0">
        <!-- Barra de navegación con Login y Registro -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">DREL-ARCHIVO</a>
                <div class="d-flex">
                    @if (Route::has('login'))
                        <div class="auth-links">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-primary me-2">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-light">Regístrate</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Carrusel de imágenes -->
        <header>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/img.jpg" class="d-block w-100" alt="img.jpg">
                    </div>
                    <div class="carousel-item">
                        <img src="img/img 1.jpg" class="d-block w-100" alt="img 1.jpg">
                    </div>
                    <div class="carousel-item">
                        <img src="img/img 2.jpg" class="d-block w-100" alt="img 2.jpg">
                    </div>
                </div>
            </div>
        </header>

        <!-- Cuerpo con información -->
        <main class="container py-5">
            <section class="info-section text-center">
                <h1>Bienvenidos a nuestra página</h1>
                <p>Esta es la página principal de nuestro sitio web, donde encontrarás toda la información relevante acerca de nuestros productos y servicios. Nos esforzamos por ofrecerte la mejor experiencia posible.</p>
                <p>Contamos con una amplia variedad de servicios que se adaptan a tus necesidades. No dudes en explorar todo lo que tenemos para ofrecer.</p>
            </section>
        </main>

        <!-- Pie de página con enlaces a redes sociales -->
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p>Síguenos en nuestras redes sociales:</p>
                <a href="https://www.facebook.com" target="_blank" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com" target="_blank" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com" target="_blank" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
