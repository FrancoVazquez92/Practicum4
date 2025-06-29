@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Detalles del Rol</h2>
    <p><strong>Nombre:</strong> {{ $rol->nombre }}</p>
    <p><strong>Descripcion:</strong> {{ $rol->descripcion }}</p>
    <p><strong>Permisos:</strong> {{ $rol->permisos }}</p>
    <a href="{{ route('rols.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
