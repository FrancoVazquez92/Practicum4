@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Seleccionar Medico</h1>

    <ul class="bg-white p-6 rounded shadow space-y-2">
        @foreach ($medicos as $medico)
            <li class="border-b py-2 flex justify-between items-center">
                <span>{{ $medico->usuario->nombre }} {{ $medico->usuario->apellido }}</span>
                <a href="{{ route('agendas.index', $medico->id) }}" class="text-blue-600 hover:underline">
                    Gestionar Agenda
                </a>
            </li>
        @endforeach
    </ul>

</div>
@endsection