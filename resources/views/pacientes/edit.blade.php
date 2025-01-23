@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Editar Paciente</h2>
    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cedula">Cedula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $paciente->cedula }}" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $paciente->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $paciente->apellido }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $paciente->telefono }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $paciente->direccion }}" required>
        </div>
        <div class="form-group">
            <label for="correoelectronico">Correo electronico</label>
            <input type="text" class="form-control" id="correoelectronico" name="correoelectronico" value="{{ $paciente->correoelectronico }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection