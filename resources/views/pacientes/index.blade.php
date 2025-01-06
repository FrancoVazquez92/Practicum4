@extends ('layouts.master')

@section ('title', 'Listado de Pacientes')

@section ('content')

    ,<h2>Listado de Pacientes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idPaciente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Correo Electronico</th>
                <th>Direccion</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection