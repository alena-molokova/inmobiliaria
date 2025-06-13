@extends('layouts.app')

@section('title', 'Registrarse - Sistema Gestión')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Registrarse</h2>

        {{-- Mostrar mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mostrar mensaje de error --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Форма регистрации --}}
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="form-label">Nombre</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                       id="first_name" name="first_name" value="{{ old('first_name') }}" 
                       placeholder="Ingresa tu nombre" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                       id="last_name" name="last_name" value="{{ old('last_name') }}" 
                       placeholder="Ingresa tu apellido" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="Ingresa tu correo" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="Ingresa tu contraseña" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       id="password_confirmation" name="password_confirmation" 
                       placeholder="Confirma tu contraseña" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">¿Ya tienes cuenta? Iniciar sesión</a>
            </div>
        </form>
    </div>
</div>
@endsection