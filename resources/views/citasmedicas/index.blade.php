@extends('layouts.master')

@section('title', 'Citas Medicas - Hospital Administracion')

@section('content')
    <h2>Citas Medicas</h2>
    
    <a href="{{ route('citasmedicas.create') }}" class="btn btn-primary mb-3">Crear Cita Medica</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Id Cita</th>
                <th>Paciente</th>
                <th></th>
                <th>Medico</th>
                <th></th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->paciente->nombre }}</td>
                    <td>{{ $cita->paciente->apellido }}</td>
                    <td>{{ $cita->medico->nombre }}</td>
                    <td>{{ $cita->medico->apellido }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->estado }}</td>
                    <td>
                        <a href="{{ route('citasmedicas.show', $cita->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('citasmedicas.edit', $cita->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('citasmedicas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection