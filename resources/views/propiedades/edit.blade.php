@extends('layouts.app')

@section('title', 'Editar Propiedad')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Propiedad</h2>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.propiedades.update', $propiedad->property_id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $propiedad->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $propiedad->city) }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="property_type" class="form-label">Tipo de Propiedad</label>
                        <select name="property_type" id="property_type" class="form-select @error('property_type') is-invalid @enderror" required>
                            <option value="Casa" {{ $propiedad->property_type == 'Casa' ? 'selected' : '' }}>Casa</option>
                            <option value="Apartamento" {{ $propiedad->property_type == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                            <option value="Terreno" {{ $propiedad->property_type == 'Terreno' ? 'selected' : '' }}>Terreno</option>
                            <option value="Comercial" {{ $propiedad->property_type == 'Comercial' ? 'selected' : '' }}>Comercial</option>
                            <option value="Dúplex" {{ $propiedad->property_type == 'Dúplex' ? 'selected' : '' }}>Dúplex</option>
                        </select>
                        @error('property_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $propiedad->price) }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $propiedad->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Disponible" {{ $propiedad->status == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="Ocupado" {{ $propiedad->status == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar Propiedad</button>
                        <a href="{{ route('empleado.propiedades') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection