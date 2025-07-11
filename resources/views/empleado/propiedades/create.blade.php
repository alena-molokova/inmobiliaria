@extends('layouts.app')

@section('title', 'Crear Propiedad - Empleado')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-home-plus text-primary"></i>
                        Crear Nueva Propiedad
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('empleado.propiedades.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Dirección *</label>
                                <input type="text" 
                                       class="form-control @error('address') is-invalid @enderror" 
                                       id="address" 
                                       name="address" 
                                       value="{{ old('address') }}" 
                                       required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Ciudad *</label>
                                <input type="text" 
                                       class="form-control @error('city') is-invalid @enderror" 
                                       id="city" 
                                       name="city" 
                                       value="{{ old('city') }}" 
                                       required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="property_type" class="form-label">Tipo de Propiedad *</label>
                                <select class="form-control @error('property_type') is-invalid @enderror" 
                                        id="property_type" 
                                        name="property_type" 
                                        required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="Casa" {{ old('property_type') == 'Casa' ? 'selected' : '' }}>Casa</option>
                                    <option value="Apartamento" {{ old('property_type') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                                    <option value="Terreno" {{ old('property_type') == 'Terreno' ? 'selected' : '' }}>Terreno</option>
                                    <option value="Comercial" {{ old('property_type') == 'Comercial' ? 'selected' : '' }}>Comercial</option>
                                    <option value="Dúplex" {{ old('property_type') == 'Dúplex' ? 'selected' : '' }}>Dúplex</option>
                                </select>
                                @error('property_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Precio *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price') }}" 
                                           step="0.01" 
                                           min="0" 
                                           required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado *</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="Disponible" {{ old('status') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="Vendido" {{ old('status') == 'Vendido' ? 'selected' : '' }}>Vendido</option>
                                <option value="Alquilado" {{ old('status') == 'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                                <option value="Pendiente" {{ old('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('empleado.propiedades.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Crear Propiedad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 