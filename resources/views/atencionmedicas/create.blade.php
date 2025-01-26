@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Crear Nueva Atención Médica</h1>
    <form action="{{ route('atencionmedicas.store') }}" method="POST">
    @csrf

    <!-- Cita Médica -->
    <div class="mb-3">
        <label for="cita_medica_id" class="form-label">Cita Médica</label>
        <select id="cita_medica_id" name="cita_medica_id" class="form-select">
            <option value="" selected disabled>Seleccione una cita</option>
            @foreach ($citas as $cita)
                <option value="{{ $cita->id }}">{{ $cita->id }}</option>
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

    <!-- Diagnóstico -->
     <div class="mb-3">
        <label for="diagnostico" class="form-label">Diagnóstico</label>
        <input type="text" name="diagnostico" id="diagnostico" class="form-control" required>
    </div>

    <!-- Tratamiento -->
    <div class="mb-3">
        <label for="tratamiento" class="form-label">Tratamiento</label>
        <select name="tratamiento" id="tratamiento" class="form-select" required>
            <option value="medicamento">Medicamento</option>
            <option value="cirugia">Cirugía</option>
            <option value="terapia">Terapia</option>
        </select>
    </div>

    <!-- Receta -->
    <div class="mb-3">
        <label for="receta" class="form-label">Receta</label>
        <input type="text" name="receta" id="receta" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
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


