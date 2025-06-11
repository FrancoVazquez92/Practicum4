<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Hospital Isidro Ayora</title>
    @vite('resources/css/app.css') <!-- Asegúrate de que Vite esté configurado -->
</head>
<body class="bg-cover bg-center h-screen" style="background-image: url('/images/fondo.png');">

    <div class="flex items-center justify-center h-full">
        <div class="bg-white bg-opacity-80 p-8 rounded shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Registro de Usuario</h1>

            <!-- Formulario de registro -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required autofocus
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                    @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="apellido">Apellido</label>
                    <input id="apellido" type="text" name="apellido" value="{{ old('apellido') }}" required
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                    @error('apellido')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Correo -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contacto -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="contacto">Número de contacto</label>
                    <input id="contacto" type="text" name="contacto" value="{{ old('contacto') }}" required
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                    @error('contacto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring focus:border-blue-500">
                </div>

                <!-- Botón -->
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-600 px-4 py-2 rounded text-white font-semibold hover:bg-blue-700 transition duration-200">
                        Registrarse
                    </button>
                    <a href="{{ route('login') }}" class="text-sm text-blue-700 hover:underline">
                        ¿Ya tienes una cuenta?
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
