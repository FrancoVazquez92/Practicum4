@extends('layouts.master')

@section('content')
<div class="container mx-auto max-w-4xl px-4">
    <h1 class="text-2xl font-bold mb-4">Citas asignadas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($citas->isEmpty())
        <p class="text-gray-600">No hay citas asignadas.</p>
    @else
        <table class="table table-bordered table-striped bg-white">
            <thead class="table-primary">
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->usuario->nombre }} {{ $cita->paciente->usuario->apellido }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                        <td class="d-flex gap-2">
                            <!-- Ver -->
                            <a href="{{ route('citasmedicas.show', $cita->id) }}" class="btn btn-info btn-sm">Ver</a>
                            
                            <!-- Editar -->
                            <a href="{{ route('citasmedicas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            
                            <!-- Eliminar -->
                            <form action="{{ route('citasmedicas.destroy', $cita->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar esta cita?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

