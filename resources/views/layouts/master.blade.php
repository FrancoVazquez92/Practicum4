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

<body style="background-color: white; background-size: cover; background-position: center; min-height: 100vh;">

    <!-- Sidebar -->
    <nav class="bg-primary bg-opacity-75 text-white p-4" style="width: 250px; height: 100vh; position: fixed; overflow-y: auto;">
        <div class="mb-4">
            <h1 class="fs-5 fw-bold">Hospital Isidro Ayora</h1>
        </div>

        @php $usuarioId = Auth::user()->id ?? null; @endphp
        @php $permisos = json_decode(Auth::user()->rol->permisos ?? '[]', true); @endphp

        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('home') }}">🏠 Inicio</a></li>
            @if(in_array('ver_dashboard', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}">📊 Dashboards</a></li>
            @endif
            @if(in_array('gestionar_administradores', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('administradores.index') }}">👤 Administradores</a></li>
            @endif
            @if(in_array('gestionar_pacientes', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('pacientes.index') }}">🧑 Pacientes</a></li>
            @endif
            @if(in_array('gestionar_doctores', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('medicos.index') }}">🩺 Doctores</a></li>
            @endif
            @if(in_array('gestionar_secretarias', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('secretarias.index') }}">📋 Secretarias</a></li>
            @endif
            @if(in_array('gestionar_gerencia', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('gerencias.index') }}">🏢 Gerencia</a></li>
            @endif
            @if(in_array('gestionar_roles', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('rols.index') }}">⚙️ Roles</a></li>
            @endif
            @if(in_array('gestionar_citas', $permisos))
                @if (Auth::user()->rol->nombre === 'Secretaria')
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('citasmedicas.seleccionarPaciente') }}">➕ Crear Cita Médica</a>
                    </li>
                @else
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('citasmedicas.index', $usuarioId) }}">📅 Citas Médicas</a>
                    </li>
                @endif
            @endif

            @if(in_array('gestionar_atenciones', $permisos))
                <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('atencionmedicas.index') }}">📝 Atención Médica</a></li>
            @endif
            @if(in_array('ver_historial', $permisos))
                @if (Auth::user()->rol->nombre === 'Medico')
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('historial.seleccionarPacienteMedico') }}">🧾 Historial de Pacientes </a>
                    </li>
                @else
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('historial.index', $usuarioId) }}">📝 Historial Medico</a></li>
                @endif
            @endif
            @if(in_array('gestionar_disponibilidad', $permisos))
                @if (Auth::user()->rol->nombre === 'Secretaria')
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="{{ route('agendas.seleccionarMedico') }}">🕒 Gestionar Agenda de un Medico</a>
                        </li>
                @else
                    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('agendas.index', $usuarioId) }}">🕒 Gestionar disponibilidad</a></li>
                @endif
            @endif
            @if(in_array('gestionar_citasAsignadas', $permisos))
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('citasmedicas.medico', $usuarioId) }}">📋 Citas asignadas</a></li>
            @endif
            @if(in_array('gestionar_emergencias', $permisos))
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('emergencias.index') }}">Emergencias</a></li>
            @endif
        </ul>
    </nav>

    <!-- Topbar -->
    <header class="bg-white shadow-sm px-4 py-2 d-flex justify-content-between align-items-center" style="position: fixed; top: 0; left: 250px; right: 0; z-index: 1040;">
        <div>
            <h5 class="mb-0 text-primary fw-bold">Panel de Usuario</h5>
        </div>
        <div class="d-flex align-items-center">
            @auth
                <div class="bg-white shadow-sm p-3 d-flex justify-content-end align-items-center" style="margin-left: 250px;">
                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" type="button" id="notificacionesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔
                        @if (Auth::user()->unreadNotifications->count())
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificacionesDropdown">
                        @forelse(Auth::user()->unreadNotifications as $noti)
                            <li class="dropdown-item small">
                                <a href="{{ route('notificaciones.marcar', $noti->id) }}" class="text-decoration-none text-dark">
                                    {{ $noti->data['mensaje'] }} <br>
                                    <small class="text-muted">{{ $noti->data['fecha'] }} a las {{ $noti->data['hora'] }}</small>
                                </a>
                            </li>
                        @empty
                            <li class="dropdown-item text-muted">Sin notificaciones nuevas</li>
                        @endforelse

                    </ul>
                </div>

                <strong class="me-3">{{ Auth::user()->nombre }}</strong>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-dark btn-sm">Cerrar sesión</button>
                </form>
           
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Registrarse</a>
            @endguest
        </div>
    </header>

    <!-- Contenido principal -->
    <main style="margin-left: 250px; padding-top: 70px;">
        <div class="container p-4 bg-white/80 rounded shadow mt-3">
            @yield('content')
        </div>

        <footer class="bg-white/80 text-center text-dark py-3 mt-4">
            &copy; {{ date('Y') }} Hospital Isidro Ayora - Loja
        </footer>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
