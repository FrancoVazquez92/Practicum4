@extends('layouts.master')

@section('content')
    <h2>Historial Médico</h2>

    @if ($historial->isEmpty())
        <p>No hay atenciones registradas.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Médico</th>
                    <th class="px-4 py-2">Diagnóstico</th>
                    <th class="px-4 py-2">Tratamiento</th>
                    <th class="px-4 py-2">Enfermedad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historial as $atencion)
                    <tr class="border-t text-sm text-gray-800">
                        <td class="px-4 py-2">{{ $atencion->cita->fecha }} {{ $atencion->cita->hora }}</td>
                        <td class="px-4 py-2">{{ $atencion->cita->medico->usuario->nombre }} {{ $atencion->cita->medico->usuario->apellido }}</td>
                        <td class="px-4 py-2">{{ $atencion->diagnostico }}</td>
                        <td class="px-4 py-2">{{ $atencion->tratamiento }}</td>
                        <td class="px-4 py-2">{{ $atencion->enfermedad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
