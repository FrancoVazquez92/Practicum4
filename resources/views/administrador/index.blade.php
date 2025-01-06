@extends ('layouts.master')

@section ('title', 'Listado de Administradores')

@section ('content')

    ,<h2>Listado de Administradores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idAdministrador</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electronico</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection