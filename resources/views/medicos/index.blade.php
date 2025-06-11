@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Medicos</h1>
    
      
    <a href="{{ route('medicos.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">+ Nuevo Medico</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="py-2 border px-4">Nombre</th>
                <th class="py-2 border px-4">Especialidad</th>
                <th class="py-2 border px-4">Correo</th>
                <th class="py-2 border px-4">Contacto</th>
                <th class="py-2 border px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
                <tr>
                    <td class="py-2 border px-4">{{ $medico->usuario->nombre }} {{ $medico->usuario->apellido }}</td>
                    <td class="py-2 border px-4">{{ $medico->especialidad }}</td>
                    <td class="py-2 border px-4">{{ $medico->usuario->email }}</td>
                    <td class="py-2 border px-4">{{ $medico->usuario->contacto }}</td>
                    <td class="py-2 border px-4 flex gap-2">
                        <a href="{{ route('medicos.show', $medico->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('medicos.edit', $medico) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('medicos.destroy', $medico) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este medico?')">
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
