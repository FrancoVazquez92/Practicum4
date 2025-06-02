<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hospital Isidro Ayora</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body class="bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center" style="background-image: url('/images/fondo.png')">
    
    <div class="bg-white bg-opacity-80 p-8 rounded shadow-lg text-center max-w-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Hospital Isidro Ayora</h1>
        <p class="text-gray-700 mb-6">Bienvenido al sistema de gestión médica. Por favor, inicia sesión o regístrate para continuar.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-green-600 px-4 py-2 rounded hover:bg-green-700">Registrarse</a>
        </div>
    </div>

</body>
</html>
