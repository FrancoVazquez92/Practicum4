@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Registrar Agenda</h1>

    <form action="{{ route('agendas.store', $medico) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label for="dia" class="block text-sm font-medium text-gray-700 mb-1">Día:</label>
            <input type="date" name="dia" id="dia" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="block text-sm font-medium text-gray-700 mb-1">Hora de Inicio</label>
            <select name="hora_inicio" id="hora_inicio" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                <option value="" disabled selected>Seleccione una hora</option>
                @for ($i = 6; $i <= 20; $i++) <!-- desde las 6:00 hasta las 20:30 -->
                    @php
                        $hora = str_pad($i, 2, '0', STR_PAD_LEFT);
                    @endphp
                    <option value="{{ $hora }}:00">{{ $hora }}:00</option>
                    <option value="{{ $hora }}:30">{{ $hora }}:30</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="block text-sm font-medium text-gray-700 mb-1">Hora de final</label>
            <select name="hora_fin" id="hora_fin" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                <option value="" disabled selected>Seleccione una hora</option>
                @for ($i = 6; $i <= 20; $i++) <!-- desde las 6:00 hasta las 20:30 -->
                    @php
                        $hora = str_pad($i, 2, '0', STR_PAD_LEFT);
                    @endphp
                    <option value="{{ $hora }}:00">{{ $hora }}:00</option>
                    <option value="{{ $hora }}:30">{{ $hora }}:30</option>
                @endfor
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
            <a href="{{ route('medicos.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
