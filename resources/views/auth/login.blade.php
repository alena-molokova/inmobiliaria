@extends('layouts.app')

@section('title', 'Login - Sistema Gestión')

@section('content')
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mostrar mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario con opción de rol --}}
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

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

            {{-- Nuevo campo: rol --}}
            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="">Selecciona un rol</option>
                    <option value="usuario" {{ old('role') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="empleado" {{ old('role') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}">¿No tienes cuenta? Registrarse</a>
            </div>
        </form>
    </div>
</div>
@endsection
