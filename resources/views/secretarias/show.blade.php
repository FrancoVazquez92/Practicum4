@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles de la secretaria</h2>
    <p><strong>Nombre:</strong> {{ $secretaria->usuario->nombre }}</p>
    <p><strong>Apellido:</strong> {{ $secretaria->usuario->apellido }}</p>
    <p><strong>Telefono:</strong> {{ $secretaria->usuario->contacto }}</p>
    <p><strong>Correo Electronico:</strong> {{ $secretaria->usuario->email }}</p>
    <a href="{{ route('secretarias.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
