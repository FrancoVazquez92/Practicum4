@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Registrar Agenda</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
            <strong>Ups, hubo algunos errores:</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('agendas.store', $medico) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label for="dia" class="block text-sm font-medium text-gray-700 mb-1">Día:</label>
            <input type="date" name="dia" id="dia" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" value="{{ old('dia') }}">
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="block text-sm font-medium text-gray-700 mb-1">Hora de Inicio</label>
            <select name="hora_inicio" id="hora_inicio" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                <option value="" disabled selected>Seleccione una hora</option>
                @for ($i = 6; $i <= 20; $i++)
                    @php $hora = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                    <option value="{{ $hora }}:00" {{ old('hora_inicio') == "$hora:00" ? 'selected' : '' }}>{{ $hora }}:00</option>
                    <option value="{{ $hora }}:30" {{ old('hora_inicio') == "$hora:30" ? 'selected' : '' }}>{{ $hora }}:30</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="block text-sm font-medium text-gray-700 mb-1">Hora de Final</label>
            <select name="hora_fin" id="hora_fin" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" required>
                <option value="" disabled selected>Seleccione una hora</option>
                @for ($i = 6; $i <= 20; $i++)
                    @php $hora = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                    <option value="{{ $hora }}:00" {{ old('hora_fin') == "$hora:00" ? 'selected' : '' }}>{{ $hora }}:00</option>
                    <option value="{{ $hora }}:30" {{ old('hora_fin') == "$hora:30" ? 'selected' : '' }}>{{ $hora }}:30</option>
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
