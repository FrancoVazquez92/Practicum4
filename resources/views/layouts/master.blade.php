<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Hospital Isidro Ayora')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="d-flex" style="background-image: url('/images/fondo.png'); background-size: cover; background-position: center; min-height: 100vh;">

    <!-- Sidebar -->
<!-- Sidebar -->
<nav class="bg-primary bg-opacity-75 text-white p-4" style="min-width: 250px; height: 100vh; position: fixed; overflow-y: auto; max-height: 100vh; scroll-behavior: smooth;">
        <div class="mb-4">
            <h1 class="fs-5 fw-bold">Hospital Isidro Ayora</h1>
        </div>

        @php $usuarioId = Auth::user()->id ?? null; @endphp

        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('home') }}">🏠 Inicio</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('administradores.index') }}">👤 Administradores</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('pacientes.index') }}">🧑 Pacientes</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('medicos.index') }}">🩺 Doctores</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('secretarias.index') }}">📋 Secretarias</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('gerencias.index') }}">🏢 Gerencia</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('rols.index') }}">⚙️ Roles</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('citasmedicas.index', $usuarioId) }}">📅 Citas Médicas</a></li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('atencionmedicas.index') }}">📝 Atención Médica</a></li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white w-100 text-start bg-transparent border-0" data-bs-toggle="collapse" data-bs-target="#submenuAgenda" aria-expanded="false" aria-controls="submenuAgenda">
                    📆 Agenda Médica
                </a>
                <div class="" id="submenuAgenda">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="{{ route('agendas.index', $usuarioId) }}">🕒 Gestionar disponibilidad</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('citasmedicas.medico', Auth::id()) }}">📋 Citas asignadas</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        @auth
            <hr class="bg-white">
            <div class="mt-3">
                <strong>{{ Auth::user()->nombre }}</strong>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('profile.show') }}">👤 Perfil</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white p-0">🚪 Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth

        @guest
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">🔐 Iniciar sesión</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">📝 Registrarse</a></li>
            </ul>
        @endguest
    </nav>

    <!-- Contenido principal -->
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container mt-4 p-4 bg-white/80 rounded shadow">
            @yield('content')
        </div>

        <footer class="bg-white/80 text-center text-dark py-3 mt-4">
            &copy; {{ date('Y') }} Hospital Isidro Ayora - Loja
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
