@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Pacientes</h1>
    
      
    <a href="{{ route('pacientes.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">+ Nuevo Paciente</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="py-2 border px-4">Nombre</th>
                <th class="py-2 border px-4">Genero</th>
                <th class="py-2 border px-4">Direccion</th>
                <th class="py-2 border px-4">Correo</th>
                <th class="py-2 border px-4">Contacto</th>
                <th class="py-2 border px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td class="py-2 border px-4">{{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}</td>
                    <td class="py-2 border px-4">{{ $paciente->genero }}</td>
                    <td class="py-2 border px-4">{{ $paciente->direccion }}</td>
                    <td class="py-2 border px-4">{{ $paciente->usuario->email }}</td>
                    <td class="py-2 border px-4">{{ $paciente->usuario->contacto }}</td>
                    <td class="py-2 border px-4 flex gap-2">
                        <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este paciente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
    </table>
</div>
@endsection
