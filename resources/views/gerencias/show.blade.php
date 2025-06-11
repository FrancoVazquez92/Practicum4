@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Gerente</h2>
    <p><strong>Nombre:</strong> {{ $gerencia->usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $gerencia->usuario->apellido }}</p>
    <p><strong>Telefono:</strong> {{ $gerencia->usuario->contacto }}</p>
    <p><strong>Correo Electronico:</strong> {{ $gerencia->usuario->email }}</p>
    <a href="{{ route('gerencias.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
