@extends ('layouts.master')

@section ('title', 'Listado de Citas de Medicas')

@section ('content')

    ,<h2>Listado de Citas Medicas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idCita</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection