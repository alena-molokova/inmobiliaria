@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container mt-5">
    <h2>Editar Usuario</h2>

    <form method="POST" action="{{ route('empleado.usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="first_name" class="form-control" value="{{ $usuario->first_name }}" required></div>
            <div class="col-md-3"><input type="text" name="last_name" class="form-control" value="{{ $usuario->last_name }}" required></div>
            <div class="col-md-3"><input type="text" name="phone" class="form-control" value="{{ $usuario->phone }}"></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required></div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary w-100">Actualizar Usuario</button>
            </div>
        </div>
    </form>
</div>
@endsection