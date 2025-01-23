@extends('layouts.master')

@section('title', 'Medicos - Hospital Administracion')

@section('content')
    <h2>Medicos</h2>
    <a href="{{ route('medicos.create') }}" class="btn btn-primary mb-3">Crear Medicos</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Especialidad</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $medico->nombre }}</td>
                    <td>{{ $medico->apellido }}</td>
                    <td>{{ $medico->especialidad }}</td>
                    <td>
                        <a href="{{ route('medicos.show', $medico->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display:inline;">
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