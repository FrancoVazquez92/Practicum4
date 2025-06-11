@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Paciente</h2>
    <p><strong>Nombre:</strong> {{ $paciente->usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $paciente->usuario->apellido }}</p>
    <p><strong>Genero:</strong> {{ $paciente->genero }}</p>
    <p><strong>Direccion:</strong> {{ $paciente->direccion }}</p>
    <p><strong>Telefono:</strong> {{ $paciente->usuario->contacto }}</p>
    <p><strong>Correo Electronico:</strong> {{ $paciente->usuario->email }}</p>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
