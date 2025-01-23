@extends ('layouts.master')

@section ('title', 'Listado de Pacientes')

@section ('content')

    <h2>Pacientes</h2>

    <a href="{{ route('pacientes.create') }}" class="btn btn-primary mb-3">Crear Paciente</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Correo Electronico</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $paciente->cedula }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->apellido }}</td>
                    <td>{{ $paciente->telefono }}</td>
                    <td>{{ $paciente->direccion }}</td>
                    <td>{{ $paciente->correoelectronico }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    
@endsection