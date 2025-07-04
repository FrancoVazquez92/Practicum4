@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Editar Emergencia</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('emergencias.update', $emergencia->id_emergencia) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_paciente" class="form-label">Nombre del Paciente</label>
            <input type="text" class="form-control" id="nombre_paciente" name="nombre_paciente" value="{{ old('nombre_paciente', $emergencia->nombre_paciente) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_identificacion" class="form-label">Número de Identificación</label>
            <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" value="{{ old('numero_identificacion', $emergencia->numero_identificacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $emergencia->fecha_nacimiento) }}" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero" name="genero" required>
                <option value="">Seleccione...</option>
                <option value="Masculino" {{ old('genero', $emergencia->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('genero', $emergencia->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('genero', $emergencia->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('emergencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
