@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Editar Secretaria</h1>

    <form action="{{ route('secretarias.update', $secretaria) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('secretarias._form', ['secretaria' => $secretaria])
        
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
            <a href="{{ route('secretarias.index') }}" class="text-blue-700 hover:underline ml-2">Cancelar</a>
        </div>
    </form>
</div>
@endsection
