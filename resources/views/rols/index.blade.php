@extends ('layouts.master')

@section ('title', 'Listado de Roles')

@section ('content')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Lista de Roles</h1>
    <a href="{{ route('rols.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Rol</a>
    <table class="table-auto w-full mt-4 border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Permisos</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
            <tr>
                <td class="border px-4 py-2">{{ $rol->nombre }}</td>
                <td class="border px-4 py-2">{{ $rol->descripcion }}</td>
                <td class="border px-4 py-2">{{ $rol->permisos }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('rols.show', $rol->id) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('rols.edit', $rol) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('rols.destroy', $rol) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este rol?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
