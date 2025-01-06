@extends ('layouts.master')

@section ('title', 'Listado de Medicos')

@section ('content')

    ,<h2>Listado de Medicos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idMedico</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Especialidad</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection