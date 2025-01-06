@extends ('layouts.master')

@section ('title', 'Listado de Reportes')

@section ('content')

    ,<h2>Listado de Reportes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idReporte</th>
                <th>Tipo</th>
                <th>Contenido</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection