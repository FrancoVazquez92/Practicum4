@extends('layouts.master')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Rol</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rols.update', $rol) }}" method="POST">
        @method('PUT')
        @include('rols._form', ['rol' => $rol])
    </form>
</div>
@endsection
