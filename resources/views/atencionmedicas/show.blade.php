@extends('layouts.master')
    
@section('content')
<div class="container">
    <h1>Detalles de la Atencion Médica</h1>

   
    <p><strong>Paciente:</strong> {{ $atenciones->paciente_nombre }}</p>
    <p><strong>Medico:</strong> {{ $atenciones->medico_nombre }} </p>
    <p><strong>Diagnóstico:</strong> {{ $atenciones->diagnostico }}</p>    
    <p><strong>Enfermedad:</strong> {{ $atenciones->enfermedad }}</p>
    <p><strong>Tratamiento:</strong> {{ $atenciones->tratamiento }}</p>
    
    <a href="{{ route('atencionmedicas.index') }}" class="btn btn-secondary">Volver</a>
</div>

@endsection