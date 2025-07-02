@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Seleccionar Paciente</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <!-- Buscador -->
        <div>
            <input type="text" id="buscador" placeholder="Buscar paciente por nombre o apellido..."
                class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2">
        </div>

        <!-- Lista de pacientes -->
        <ul id="lista-pacientes" class="divide-y divide-gray-200">
            @foreach ($pacientes as $paciente)
                <li class="py-2 flex justify-between items-center">
                    <span>
                        {{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}
                    </span>
                    <a href="{{ route('citasmedicas.create', $paciente->id) }}"
                        class="text-blue-600 hover:underline">
                        Crear Cita
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    document.getElementById('buscador').addEventListener('input', function () {
        const filtro = this.value.toLowerCase();
        const lista = document.getElementById('lista-pacientes');
        const items = lista.getElementsByTagName('li');

        Array.from(items).forEach(item => {
            const texto = item.textContent.toLowerCase();
            item.style.display = texto.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endsection

