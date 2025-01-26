@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Atenciones Médicas</h1>

    <a href="{{ route('atencionmedicas.create') }}" class="btn btn-primary">Nueva Atención Médica</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Diagnóstico</th>
                <th>Tratamiento</th>
                <th>Receta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($atenciones as $atencion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $atencion->id }}</td>
                    <td>{{ $atencion->paciente_nombre }}</td>
                    <td>{{ $atencion->medico_nombre }}</td>
                    <td>{{ $atencion->diagnostico }}</td>
                    <td>{{ $atencion->tratamiento }}</td>
                    <td>{{ $atencion->receta }}</td>
                    <td>
                        <a href="{{ route('atencionmedicas.show', $atencion->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('atencionmedicas.edit', $atencion->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('atencionmedicas.destroy', $atencion->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
