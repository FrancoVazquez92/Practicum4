@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Crear Cita Médica</h1>

    <form action="{{ route('citasmedicas.store', $paciente) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paciente:</label>
            <input type="text" disabled value="{{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}" class="w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Especialidad:</label>
            <select id="especialidad" class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Seleccione --</option>
                @foreach($especialidades as $especialidad)
                    <option value="{{ $especialidad }}">{{ $especialidad }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Médico:</label>
            <select name="medico_id" id="medico" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Seleccione un médico --</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha disponible:</label>
            <select name="fecha" id="dia" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Seleccione una fecha --</option>
            </select>
        </div>

        <div>
            <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">Hora disponible:</label>
            <select name="hora" id="horarios" required class="w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Seleccione una hora --</option>
            </select>     
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
            <a href="{{ route('citasmedicas.index', $paciente) }}" class="ml-2 text-blue-700 hover:underline">Cancelar</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('especialidad').addEventListener('change', function () {
        
        const especialidad = this.value;
        fetch(`/medicos/por-especialidad/${especialidad}`)                
            .then(res => res.json())
            .then(medicos => {                             
                const medicoSelect = document.getElementById('medico');
                medicoSelect.innerHTML = '<option value="">-- Seleccione un médico --</option>';
                medicos.forEach(medico => {
                    const nombre = `${medico.usuario?.nombre || ''} ${medico.usuario?.apellido || ''}`.trim();
                    medicoSelect.innerHTML += `<option value="${medico.id}">${nombre}</option>`;
                });
            });
    });

    document.getElementById('medico').addEventListener('change', function () {
        const medicoId = this.value;
        const diaSelect = document.getElementById('dia');

        if (!medicoId) return;

        fetch(`/agenda/fechas-disponibles/${medicoId}`)
            .then(res => res.json())
            .then(fechas => {
                diaSelect.innerHTML = '<option value="">-- Seleccione una fecha --</option>';
                fechas.forEach(fecha => {
                    diaSelect.innerHTML += `<option value="${fecha}">${fecha}</option>`;
                });
            });
    });

    document.getElementById('dia').addEventListener('change', function () {
        const fecha = this.value;
        const medicoId = document.getElementById('medico').value;

        if (!fecha || !medicoId) return;     

        fetch(`/agenda/horarios-disponibles/${medicoId}/${fecha}`)
            .then(res => res.json())
            .then(horarios => {
                const horaSelect = document.getElementById('horarios');
                horaSelect.innerHTML = '<option value="">-- Seleccione una hora --</option>';
                horarios.forEach(hora => {
                    horaSelect.innerHTML += `<option value="${hora}">${hora}</option>`;
                });
            });
    });

</script>
@endsection
