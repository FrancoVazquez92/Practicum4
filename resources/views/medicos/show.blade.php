@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Medico</h2>
    <p><strong>Nombre:</strong> {{ $medico->usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $medico->usuario->apellido }}</p>
    <p><strong>Telefono:</strong> {{ $medico->usuario->contacto }}</p>
    <p><strong>Correo Electronico:</strong> {{ $medico->usuario->email }}</p>
    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
