@extends('layouts.app')

@section('title', 'Editar Propiedad')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary fw-bold">Editar Propiedad</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.propiedades.update', $propiedad->property_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Dirección</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $propiedad->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label fw-semibold">Ciudad</label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $propiedad->city) }}" required>
                </div>

                <div class="mb-3">
                    <label for="property_type" class="form-label fw-semibold">Tipo de Propiedad</label>
                    <select id="property_type" name="property_type" class="form-select" required>
                        @php
                            $tipos = ['Casa', 'Apartamento', 'Terreno', 'Comercial', 'Dúplex'];
                        @endphp
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo }}" {{ old('property_type', $propiedad->property_type) === $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">Precio</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $propiedad->price) }}" min="0" step="any" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Descripción</label>
                    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $propiedad->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-semibold">Estado</label>
                    <select id="status" name="status" class="form-select" required>
                        @php
                            $estados = ['disponible' => 'Disponible', 'vendido' => 'Vendido', 'alquilado' => 'Alquilado'];
                        @endphp
                        @foreach($estados as $valor => $label)
                            <option value="{{ $valor }}" {{ old('status', $propiedad->status) === $valor ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('empleado.propiedades.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary fw-semibold px-4">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection