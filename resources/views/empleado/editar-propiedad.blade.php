@extends('layouts.app')

@section('title', 'Editar Propiedad')

@section('content')
<div class="container mt-5">
    <h2>Editar Propiedad</h2>

    <form method="POST" action="{{ route('empleado.propiedades.update', $propiedad->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $propiedad->direccion }}" required>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="text" name="precio" class="form-control" value="{{ $propiedad->precio }}" required>
        </div>

        <div class="mb-3">
            <label>Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $propiedad->tipo }}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleado.propiedades') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection