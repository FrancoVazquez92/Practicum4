@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Gerente</h1>

    <form action="{{ route('gerencias.update', $gerencia) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('gerencias._form', ['gerencia' => $gerencia])
        
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
            <a href="{{ route('gerencias.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
