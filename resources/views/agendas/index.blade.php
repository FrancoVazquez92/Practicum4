@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Agenda del Dr. {{ $medico->usuario->nombre }} {{ $medico->usuario->apellido }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('agendas.create', $medico) }}" class="btn btn-primary mb-3">Agregar disponibilidad</a>


    @if($medico->agendas->isEmpty())
        <p>No hay horarios disponibles registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medico->agendas as $agenda)
                    <tr>
                        <td>{{ ucfirst($agenda->dia) }}</td>
                        <td>{{ \Carbon\Carbon::parse($agenda->hora_inicio)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($agenda->hora_fin)->format('H:i') }}</td>
                        <td>
                            <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta disponibilidad?')">
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
