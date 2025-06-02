<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Hospital Isidro Ayora</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('/images/fondo.png');">
    <div class="bg-white bg-opacity-80 p-8 rounded shadow-lg max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-blue-900 mb-6">Hospital Isidro Ayora</h1>
        <h2 class="text-xl text-center mb-6">Iniciar Sesión</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 flex items-center justify-between">
                <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Recuérdame
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-600 px-4 py-2 text-white rounded hover:bg-blue-700 w-full">
                    Iniciar Sesión
                </button>
            </div>

            <div class="text-center">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Regístrate</a>
            </div>
        </form>
    </div>
</body>
</html>
