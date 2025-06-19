@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles de la Cita Médica</h1>

    
    <p><strong>Paciente:</strong> {{ $citas->paciente->nombre }} {{ $citas->paciente->apellido }}</p>
    <p><strong>Medico:</strong> {{ $citas->medico->nombre }} {{ $citas->medico->apellido }}</p>
    <p><strong>Fecha:</strong> {{ $citas->fecha }}</p>
    <p><strong>Hora:</strong> {{ $citas->hora }}</p>
    
    <a href="{{ Auth::user()->rol->nombre == 'Medico' 
        ? route('citasmedicas.medico', $citas->medico_id) 
        : route('citasmedicas.index', $citas->paciente_id) }}" 
    class="btn btn-secondary mt-3">
        Volver
    </a>

</div>

@endsection
