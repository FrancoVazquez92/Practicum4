@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Seleccionar Paciente</h1>

    <ul class="bg-white p-6 rounded shadow space-y-2">
        @foreach ($pacientes as $paciente)
            <li class="border-b py-2 flex justify-between items-center">
                <span>{{ $paciente->usuario->nombre }} {{ $paciente->usuario->apellido }}</span>
                <a href="{{ route('historial.index', $paciente->id) }}" class="text-blue-600 hover:underline">
                    Ver historial
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
