@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Medico</h2>
    <p><strong>Nombre:</strong> {{ $medico->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $medico->apellido }}</p>
    <p><strong>Especialidad:</strong> {{ $medico->especialidad }}</p>
    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection