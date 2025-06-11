@extends('layouts.master')

@section('content')
  
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Registrar Gerente</h1>

    <form action="{{ route('gerencias.store') }}" method="POST" class="space-y-4">
        @csrf

        @include('gerencias._form', ['gerencia' => null])
        
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
            <a href="{{ route('gerencias.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection