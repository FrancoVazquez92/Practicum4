@extends ('layouts.master')

@section ('title', 'Listado de Pacientes')

@section ('content')

    ,<h2>Listado de Pacientes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Numero de factura</th>
                <th>Datos razon social</th>
                <th>Datos del cliente</th>
                <th>Detalle</th>
                <th>Impuestos</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            //Codigo en php para consulta base de datos  de la tabla pacientes.
        </tbody>

    </table>
    
@endsection