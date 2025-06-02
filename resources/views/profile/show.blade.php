@extends('layouts.master')

@section('title', 'Perfil de Usuario')

@section('content')
    <h2 class="mb-4 text-center fw-bold text-primary">Perfil de Usuario</h2>

    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title text-center">{{ $usuario->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>
            <p class="card-text"><strong>Registrado desde:</strong> {{ $usuario->created_at->format('d/m/Y') }}</p>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary">Volver al Inicio</a>
            </div>
        </div>
    </div>
@endsection
