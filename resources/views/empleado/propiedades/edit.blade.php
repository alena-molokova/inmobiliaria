@extends('layouts.app')

@section('title', 'Editar Propiedad')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar Propiedad</h2>

    <form action="{{ route('empleado.propiedades.update', $propiedad->property_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección de la propiedad" value="{{ old('address', $propiedad->address) }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input name="city" type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" value="{{ old('city', $propiedad->city) }}">
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de Propiedad</label>
            <select name="property_type" class="form-select @error('property_type') is-invalid @enderror">
                <option value="">Seleccionar tipo</option>
                <option value="Casa" {{ old('property_type', $propiedad->property_type) == 'Casa' ? 'selected' : '' }}>Casa</option>
                <option value="Departamento" {{ old('property_type', $propiedad->property_type) == 'Departamento' ? 'selected' : '' }}>Departamento</option>
                <option value="Local" {{ old('property_type', $propiedad->property_type) == 'Local' ? 'selected' : '' }}>Local</option>
                <option value="Terreno" {{ old('property_type', $propiedad->property_type) == 'Terreno' ? 'selected' : '' }}>Terreno</option>
            </select>
            @error('property_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input name="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" placeholder="Precio de la propiedad" value="{{ old('price', $propiedad->price) }}">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descripción de la propiedad">{{ old('description', $propiedad->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Seleccionar estado</option>
                <option value="Disponible" {{ old('status', $propiedad->status) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Alquilado" {{ old('status', $propiedad->status) == 'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                <option value="Vendido" {{ old('status', $propiedad->status) == 'Vendido' ? 'selected' : '' }}>Vendido</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Propiedad</button>
        <a href="{{ route('empleado.propiedades') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection