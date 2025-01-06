@extends ('layouts.master')

@section ('title', 'Listado de Agenda')

@section ('content')

    ,<h2>Listado de Agenda</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>idMedico</th>
                <th>Disponibilidad</th>
                <th>Horario</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection