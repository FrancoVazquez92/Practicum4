@extends ('layouts.master')

@section ('title', 'Listado de Historial Medico')

@section ('content')

    ,<h2>Listado de Historial Medico</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idHistorial</th>
                <th>Fecha Actualizacion</th>
                <th>Diagnostico</th>
                <th>Tratamiento</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection