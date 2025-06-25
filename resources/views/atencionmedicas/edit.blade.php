@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Editar Atención Médica</h1>

    <form action="{{ route('atencionmedicas.update', $atencion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Cita Médica (solo lectura) -->
        <div class="mb-3">
            <label for="cita_medica_texto" class="form-label">Cita Médica</label>
            <input type="text" class="form-control" id="cita_medica_texto" value="Cita #{{ $atencion->cita->id }} - {{ $atencion->cita->paciente->usuario->nombre }} {{ $atencion->cita->paciente->usuario->apellido }} ({{ $atencion->cita->fecha }} {{ $atencion->cita->hora }})" readonly>
            <input type="hidden" name="cita_medica_id" value="{{ $atencion->cita->id }}">
        </div>

        <!-- Paciente -->
        <div class="mb-3">
            <label for="paciente_nombre" class="form-label">Paciente</label>
            <input type="text" name="paciente_nombre" id="paciente_nombre" class="form-control" readonly required
                   value="{{ $atencion->cita->paciente->usuario->nombre }} {{ $atencion->cita->paciente->usuario->apellido }}">
        </div>

        <!-- Médico -->
        <div class="mb-3">
            <label for="medico_nombre" class="form-label">Médico</label>
            <input type="text" name="medico_nombre" id="medico_nombre" class="form-control" readonly required
                   value="{{ $atencion->cita->medico->usuario->nombre }} {{ $atencion->cita->medico->usuario->apellido }}">
        </div>

        <!-- Diagnóstico -->
        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <input type="text" class="form-control" id="diagnostico" name="diagnostico"
                   value="{{ old('diagnostico', $atencion->diagnostico) }}" required>
        </div>

        <!-- Tratamiento -->
        <div class="mb-3">
            <label for="tratamiento" class="form-label">Tratamiento</label>
            <input type="text" class="form-control" id="tratamiento" name="tratamiento"
                   value="{{ old('tratamiento', $atencion->tratamiento) }}" required>
        </div>

        <!-- Enfermedad -->
        <div class="mb-3">
            <label for="enfermedad" class="form-label">Enfermedad</label>
            <input type="text" class="form-control" id="enfermedad" name="enfermedad"
                   value="{{ old('enfermedad', $atencion->enfermedad) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('atencionmedicas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
