@extends('layouts.master')

@section('content')
  
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Registrar Medico</h1>

    <form action="{{ route('medicos.store') }}" method="POST" class="space-y-4">
        @csrf

        @include('medicos._form', ['medico' => null])
        
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
            <a href="{{ route('medicos.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection