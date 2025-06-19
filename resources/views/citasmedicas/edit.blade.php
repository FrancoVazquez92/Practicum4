@extends('layouts.master')

@section('content')
<div class="container mx-auto max-w-xl px-4">
    <h1 class="text-2xl font-bold mb-4">Editar Cita Médica</h1>

    <form action="{{ route('citasmedicas.update', $cita->id) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <!-- Seleccionar Paciente -->
        <div>
            <label for="paciente_id" class="block text-sm font-medium text-gray-700 mb-1">Paciente:</label>
            <select name="paciente_id" id="paciente_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Seleccionar Médico -->
        <div>
            <label for="medico_id" class="block text-sm font-medium text-gray-700 mb-1">Médico:</label>
            <select name="medico_id" id="medico_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}" {{ $cita->medico_id == $medico->id ? 'selected' : '' }}>
                        {{ $medico->usuario->nombre }} {{ $medico->usuario->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha -->
        <div>
            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $cita->fecha }}" required>
        </div>

        <!-- Hora -->
        <div>
            <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora:</label>
            <input type="time" name="hora" id="hora" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ $cita->hora }}" required>
        </div>

        <div class="flex items-center space-x-4 mt-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar</button>

            <a href="{{ Auth::user()->rol->nombre == 'medico' 
                        ? route('citasmedicas.medico', $cita->medico_id) 
                        : route('citasmedicas.index', $cita->paciente_id) }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection

