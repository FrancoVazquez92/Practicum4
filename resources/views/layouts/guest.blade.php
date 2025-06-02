<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Hospital Isidro Ayora') }}</title>

    @vite('resources/css/app.css') <!-- Tailwind y otros estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="min-h-screen bg-cover bg-center d-flex justify-content-center align-items-center" style="background-image: url('/images/fondo.png');">

    <div class="container p-4 bg-white bg-opacity-80 rounded shadow" style="max-width: 500px;">
        <!-- Aquí se renderiza el contenido de la vista -->
        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
