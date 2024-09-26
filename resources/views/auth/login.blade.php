<!doctype html>
<html lang="es">
    <head>
        <title>LOGIN-ARCHIVO</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{asset('assets/estilos.css')}}">

    </head>

    <body>
    <form method="POST" action="{{ route('login') }}">@csrf
    <div class="login-container">
        <!-- Imagen al costado -->
        <div class="image-side">
            <img src="img/img.jpg" alt="img.jpg">
        </div>

        <!-- Formulario de login -->
        <div class="form-side">
            <h2>Inicia Sesión</h2>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input id="email" type="email" name="email" required autofocus />
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input id="password" type="password" name="password" required />
                </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
            <p class="signup-text">¿No tienes cuenta? <a href="/register">Regístrate</a></p>
        </div>
    </div>
</form>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
