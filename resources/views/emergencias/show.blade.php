@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Detalles de Emergencia</h2>

    <table class="table table-bordered">
        <tr>
            <th>Nombre del Paciente</th>
            <td>{{ $emergencia->nombre_paciente }}</td>
        </tr>
        <tr>
            <th>Número de Identificación</th>
            <td>{{ $emergencia->numero_identificacion }}</td>
        </tr>
        <tr>
            <th>Fecha de Nacimiento</th>
            <td>{{ $emergencia->fecha_nacimiento }}</td>
        </tr>
        <tr>
            <th>Género</th>
            <td>{{ $emergencia->genero }}</td>
        </tr>
    </table>

    <a href="{{ route('emergencias.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('emergencias.edit', $emergencia->id_emergencia) }}" class="btn btn-primary">Editar</a>
</div>
@endsection
