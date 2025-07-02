@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Cita Médica</h1>

    <form action="{{ route('citasmedicas.update', $cita->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <!-- Paciente -->
        <input type="hidden" name="paciente_id" value="{{ $cita->paciente_id }}">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paciente:</label>
            <input type="text" disabled value="{{ $cita->paciente->usuario->nombre }} {{ $cita->paciente->usuario->apellido }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Especialidad (solo lectura) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad:</label>
            <input type="text" value="{{ $cita->medico->especialidad }}" disabled class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100">
        </div>

        <!-- Médico (solo lectura) -->
        <input type="hidden" name="medico_id" value="{{ $cita->medico_id }}">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Médico:</label>
            <input type="text" disabled value="{{ $cita->medico->usuario->nombre }} {{ $cita->medico->usuario->apellido }}" class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100">
        </div>

        <!-- Fecha -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha disponible:</label>
            <select name="fecha" id="dia" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="{{ $cita->fecha }}" selected>{{ $cita->fecha }}</option>
            </select>
        </div>

        <!-- Hora -->
        <div>
            <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora disponible:</label>
            <select name="hora" id="horarios" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="{{ $cita->hora }}" selected>{{ $cita->hora }}</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Actualizar</button>
            <a href="{{ Auth::user()->rol->nombre == 'medico' 
                        ? route('citasmedicas.medico', $cita->medico_id) 
                        : route('citasmedicas.index', $cita->paciente_id) }}" 
               class="ml-2 text-blue-700 hover:underline">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const medicoId = "{{ $cita->medico_id }}";
    const fechaActual = "{{ $cita->fecha }}";
    const horaActual = "{{ $cita->hora }}";

    const diaSelect = document.getElementById('dia');
    const horaSelect = document.getElementById('horarios');

    // Cargar fechas disponibles al iniciar
    fetch(`/agenda/fechas-disponibles/${medicoId}`)
        .then(res => res.json())
        .then(fechas => {
            diaSelect.innerHTML = '<option value="">-- Seleccione una fecha --</option>';
            fechas.forEach(fecha => {
                const selected = fecha === fechaActual ? 'selected' : '';
                diaSelect.innerHTML += `<option value="${fecha}" ${selected}>${fecha}</option>`;
            });
        });

    // Cargar horas disponibles de la fecha actual al iniciar
    fetch(`/agenda/horarios-disponibles/${medicoId}/${fechaActual}`)
        .then(res => res.json())
        .then(horas => {
            horaSelect.innerHTML = '<option value="">-- Seleccione una hora --</option>';
            horas.forEach(hora => {
                const selected = hora === horaActual ? 'selected' : '';
                horaSelect.innerHTML += `<option value="${hora}" ${selected}>${hora}</option>`;
            });
        });

    // Si cambia la fecha, cargar nuevas horas
    diaSelect.addEventListener('change', function () {
        const nuevaFecha = this.value;
        if (!nuevaFecha) return;

        fetch(`/agenda/horarios-disponibles/${medicoId}/${nuevaFecha}`)
            .then(res => res.json())
            .then(horas => {
                horaSelect.innerHTML = '<option value="">-- Seleccione una hora --</option>';
                horas.forEach(hora => {
                    horaSelect.innerHTML += `<option value="${hora}">${hora}</option>`;
                });
            });
    });
});
</script>
@endsection



