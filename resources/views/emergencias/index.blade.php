@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Listado de Emergencias</h1>
    <a href="{{ route('emergencias.create') }}" class="btn btn-primary mb-3">Nueva emergencia</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Paciente</th>
                <th>Número Identificación</th>
                <th>Fecha Nacimiento</th>
                <th>Género</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($emergencias as $emergencia)
            <tr>
                <td>{{ $emergencia->id_emergencia }}</td>
                <td>{{ $emergencia->nombre_paciente }}</td>
                <td>{{ $emergencia->numero_identificacion }}</td>
                <td>{{ $emergencia->fecha_nacimiento }}</td>
                <td>{{ $emergencia->genero }}</td>
                <td>{{ $emergencia->categoria }}</td>
                <td>

                    <!-- Botón Ver Triaje -->
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#triajeModal{{ $emergencia->id_emergencia }}">
                        Ver Triaje
                    </button>
                </td>
            </tr>

            <!-- Modal para mostrar Triaje -->
            <div class="modal fade" id="triajeModal{{ $emergencia->id_emergencia }}" tabindex="-1" aria-labelledby="triajeModalLabel{{ $emergencia->id_emergencia }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="triajeModalLabel{{ $emergencia->id_emergencia }}">Datos del Triaje - Emergencia #{{ $emergencia->id_emergencia }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            @if($emergencia->triaje)
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Frecuencia Cardiaca:</strong> {{ $emergencia->triaje->frecuencia_cardiaca }}</li>
                                    <li class="list-group-item"><strong>Frecuencia Respiratoria:</strong> {{ $emergencia->triaje->frecuencia_respiratoria }}</li>
                                    <li class="list-group-item"><strong>Presión Arterial Sistólica:</strong> {{ $emergencia->triaje->presion_arterial_sistolica }}</li>
                                    <li class="list-group-item"><strong>Saturación de Oxígeno (SpO2):</strong> {{ $emergencia->triaje->saturacion_oxigeno }}</li>
                                    <li class="list-group-item"><strong>Nivel de Conciencia (AVPU):</strong> {{ $emergencia->triaje->nivel_conciencia }}</li>
                                    <li class="list-group-item"><strong>Puntaje:</strong> {{ $emergencia->triaje->puntaje }}</li>

                                </ul>
                            @else
                                <p>No hay datos de triaje asociados.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
