@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Listado de Secretarias</h1>

    <a href="{{ route('secretarias.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">+ Nueva Secretaria</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="py-2 border px-4">Nombre</th>
                <th class="py-2 border px-4">Correo</th>
                <th class="py-2 border px-4">Contacto</th>
                <th class="py-2 border px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($secretarias as $secretaria)
                <tr>
                    <td class="py-2 border px-4">{{ $secretaria->usuario->nombre }} {{ $secretaria->usuario->apellido }}</td>
                    <td class="py-2 border px-4">{{ $secretaria->usuario->email }}</td>
                    <td class="py-2 border px-4">{{ $secretaria->usuario->contacto }}</td>
                    <td class="py-2 border px-4 flex gap-2">
                        <a href="{{ route('secretarias.show', $secretaria->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('secretarias.edit', $secretaria) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('secretarias.destroy', $secretaria) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta secretaria?')">
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
