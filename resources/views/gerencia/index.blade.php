@extends ('layouts.master')

@section ('title', 'Listado de Gerentes')

@section ('content')

    ,<h2>Listado de Gerente</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idGerente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electronico</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection