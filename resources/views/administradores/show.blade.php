@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Administrador</h2>
    <p><strong>Nombre:</strong> {{ $administrador->usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $administrador->usuario->apellido }}</p>
    <p><strong>Telefono:</strong> {{ $administrador->usuario->contacto }}</p>
    <p><strong>Correo Electronico:</strong> {{ $administrador->usuario->email }}</p>
    <a href="{{ route('administradores.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
