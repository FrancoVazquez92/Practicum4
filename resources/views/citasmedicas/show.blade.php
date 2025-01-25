@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Detalles de la Cita Médica</h1>

    
    <p><strong>Paciente:</strong> {{ $citas->paciente->nombre }} {{ $citas->paciente->apellido }}</p>
    <p><strong>Medico:</strong> {{ $citas->medico->nombre }} {{ $citas->medico->apellido }}</p>
    <p><strong>Fecha:</strong> {{ $citas->fecha }}</p>
    <p><strong>Hora:</strong> {{ $citas->hora }}</p>
    
    <a href="{{ route('citasmedicas.index') }}" class="btn btn-secondary">Volver</a>
</div>

@endsection
