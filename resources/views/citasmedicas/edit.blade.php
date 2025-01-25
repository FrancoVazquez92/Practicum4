@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Editar Cita Médica</h1>

    <form action="{{ route('citasmedicas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Seleccionar Paciente -->
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-select" required>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Seleccionar Médico -->
        <div class="mb-3">
            <label for="medico_id" class="form-label">Médico</label>
            <select name="medico_id" id="medico_id" class="form-select" required>
                @foreach ($medicos as $medico)
                    <option value="{{ $medico->id }}" {{ $cita->medico_id == $medico->id ? 'selected' : '' }}>
                        {{ $medico->nombre }} {{ $medico->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $cita->fecha }}" required>
        </div>

        <!-- Hora -->
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ $cita->hora }}" required>
        </div>

        <!-- Botón de Guardar -->
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <a href="{{ route('citasmedicas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
</div>
@endsection
