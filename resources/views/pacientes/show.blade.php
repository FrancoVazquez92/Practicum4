@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Paciente</h2>
    <p><strong>Cedula:</strong> {{ $paciente->cedula }}</p>
    <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $paciente->apellido }}</p>
    <p><strong>Telefono:</strong> {{ $paciente->telefono }}</p>
    <p><strong>Direccion:</strong> {{ $paciente->direccion }}</p>
    <p><strong>Correo Electronico:</strong> {{ $paciente->correoelectronico }}</p>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
