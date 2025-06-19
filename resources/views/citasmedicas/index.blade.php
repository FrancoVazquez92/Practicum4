@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-4xl">
    <h2 class="text-2xl font-bold mb-4">Citas del paciente: {{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('citasmedicas.create', $paciente) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        Agregar cita
    </a>

    @if($paciente->citasmedicas->isEmpty())
        <p class="text-gray-600">No hay citas registradas.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded shadow">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Hora</th>
                        <th class="px-4 py-2">Médico</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paciente->citasmedicas as $cita)
                        <tr class="border-t text-sm text-gray-800">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                            <td class="px-4 py-2">
                                {{ $cita->medico->usuario->nombre }} {{ $cita->medico->usuario->apellido }}
                            </td>
                            <td class="px-4 py-2 space-x-1">
                                <!-- Ver -->
                                <a href="{{ route('citasmedicas.show', $cita->id) }}" class="btn btn-info btn-sm">
                                    Ver
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('citasmedicas.edit', $cita->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <!-- Eliminar -->
                                <form action="{{ route('citasmedicas.destroy', $cita->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de cancelar esta cita?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

