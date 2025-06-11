<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Hospital Isidro Ayora')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind (si lo usas junto a Bootstrap) -->
    @vite('resources/css/app.css')

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body style="background-image: url('/images/fondo.png'); background-size: cover; background-position: center;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-opacity-75">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a class="navbar-brand fw-bold" href="#">Hospital Isidro Ayora</a>

            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('administradores.index') }}">Administradores</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('pacientes.index') }}">Pacientes</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('medicos.index') }}">Doctores</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('secretarias.index') }}">Secretarias</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('rols.index') }}">Roles</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('citasmedicas.index') }}">Citas Médicas</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="{{ route('atencionmedicas.index') }}">Atención Médica</a></li>
            </ul>

            @auth
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="usuarioDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nombre }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Ver Perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth

            @guest
                <ul class="navbar-nav flex-row">
                    <li class="nav-item me-3"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                </ul>
            @endguest
        </div>
    </nav>

    <div class="container mt-4 p-4 bg-white/80 rounded shadow">
        @yield('content')
    </div>

    <footer class="bg-white/80 text-center text-dark py-3 mt-4">
        &copy; {{ date('Y') }} Hospital Isidro Ayora - Loja
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
