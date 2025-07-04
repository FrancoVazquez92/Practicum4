@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Registrar Emergencia y Triaje</h1>

    <form action="{{ route('emergencias.store') }}" method="POST">
        @csrf

        <!-- Selección de paciente -->
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-select" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option
                        value="{{ $paciente->id }}"
                        data-nombre="{{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}"
                        data-numero="{{ $paciente->numero_identificacion }}"
                        data-fecha="{{ $paciente->fecha_nacimiento }}"
                        data-genero="{{ $paciente->genero }}"
                    >
                        {{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }} - {{ $paciente->numero_identificacion }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo oculto para enviar el nombre completo -->
        <input type="hidden" name="nombre_paciente" id="nombre_paciente" value="">

        <div class="mb-3">
            <label for="numero_identificacion" class="form-label">Número de Identificación</label>
            <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <input type="text" name="genero" id="genero" class="form-control" readonly>
        </div>

        <hr>
        <h4>Datos del Triaje</h4>

        <div class="mb-3">
            <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardíaca</label>
            <input type="number" name="frecuencia_cardiaca" id="frecuencia_cardiaca" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="frecuencia_respiratoria" class="form-label">Frecuencia Respiratoria</label>
            <input type="number" name="frecuencia_respiratoria" id="frecuencia_respiratoria" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="presion_arterial_sistolica" class="form-label">Presión Arterial Sistólica</label>
            <input type="number" name="presion_arterial_sistolica" id="presion_arterial_sistolica" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="saturacion_oxigeno" class="form-label">Saturación de Oxígeno (SpO2)</label>
            <input type="number" name="saturacion_oxigeno" id="saturacion_oxigeno" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nivel_conciencia" class="form-label">Nivel de Conciencia (AVPU)</label>
            <select name="nivel_conciencia" id="nivel_conciencia" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Alerta">Alerta</option>
                <option value="Verbal">Responde a verbal</option>
                <option value="Dolor">Responde al dolor</option>
                <option value="Inconsciente">Inconsciente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Emergencia y Triaje</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pacienteSelect = document.getElementById('paciente_id');
    const nombreInput = document.getElementById('nombre_paciente');
    const numeroInput = document.getElementById('numero_identificacion');
    const fechaInput = document.getElementById('fecha_nacimiento');
    const generoInput = document.getElementById('genero');

    pacienteSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        nombreInput.value = selected.getAttribute('data-nombre') || '';
        numeroInput.value = selected.getAttribute('data-numero') || '';
        fechaInput.value = selected.getAttribute('data-fecha') || '';
        generoInput.value = selected.getAttribute('data-genero') || '';
    });
});
</script>
@endsection
