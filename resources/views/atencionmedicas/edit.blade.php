@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Editar Atención Médica</h1>

    <form action="{{ route('atencionmedicas.update', $atencion->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Esto es necesario para que el formulario se envíe como PUT para actualizar -->

        <!-- Campo para la cita médica -->
        <div class="form-group">
            <label for="cita_medica_id">Cita Médica</label>
            <select class="form-control" id="cita_medica_id" name="cita_medica_id" required>
                @foreach($citas as $cita)
                    <option value="{{ $cita->id }}" {{ $cita->id == $atencion->cita_medica_id ? 'selected' : '' }}>
                        Cita #{{ $cita->id }} - {{ $cita->fecha }}
                    </option>
                @endforeach
            </select>
        </div>

         <!-- Paciente -->
            <div class="mb-3">
                <label for="paciente_nombre" class="form-label">Paciente</label>
                <input type="text" name="paciente_nombre" id="paciente_nombre" class="form-control" readonly required>
            </div>

            <!-- Médico -->
            <div class="mb-3">
                <label for="medico_nombre" class="form-label">Médico</label>
                <input type="text" name="medico_nombre" id="medico_nombre" class="form-control" readonly required>
            </div>

        <!-- Campo para el diagnóstico -->
        <div class="form-group">
            <label for="diagnostico">Diagnóstico</label>
            <input type="text" class="form-control" id="diagnostico" name="diagnostico" value="{{ old('diagnostico', $atencion->diagnostico) }}" required>
        </div>

        <!-- Campo para el tratamiento -->
        <div class="form-group">
            <label for="tratamiento">Tratamiento</label>
            <select class="form-control" id="tratamiento" name="tratamiento" required>
                <option value="medicamento" {{ old('tratamiento', $atencion->tratamiento) == 'medicamento' ? 'selected' : '' }}>Medicamento</option>
                <option value="cirugía" {{ old('tratamiento', $atencion->tratamiento) == 'cirugía' ? 'selected' : '' }}>Cirugía</option>
                <option value="terapia" {{ old('tratamiento', $atencion->tratamiento) == 'terapia' ? 'selected' : '' }}>Terapia</option>
            </select>
        </div>

        <!-- Campo para la receta -->
        <div class="form-group">
            <label for="receta">Receta</label>
            <input type="text" class="form-control" id="receta" name="receta" value="{{ old('receta', $atencion->receta) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('atencionmedicas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        document.getElementById('cita_medica_id').addEventListener('change', function () {
        const citaId = this.value; // Obtiene el ID de la cita seleccionada
        console.log(`Cita seleccionada: ${citaId}`); // Verifica que el ID sea correcto
        if (!citaId) return;

            fetch(`/citasmedicas/${citaId}/detalles`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('No se encontraron detalles para la cita seleccionada.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos:', data); // Verifica que los datos llegan correctamente
                    document.getElementById('paciente_nombre').value = `${data.paciente.nombre} ${data.paciente.apellido}`;;
                    document.getElementById('medico_nombre').value = `${data.medico.nombre} ${data.medico.apellido}`;
                })
                .catch(error => {
                    alert(error.message); // Muestra el error si no se encuentra la cita
                });
        });

    </script>
</div>
@endsection
