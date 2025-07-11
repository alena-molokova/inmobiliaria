@extends('layouts.app')

@section('title', 'Propiedades')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Propiedades</h2>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Agregar Propiedad</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.propiedades.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for=" Деaddress" class="form-label">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="property_type" class="form-label">Tipo de Propiedad</label>
                        <select name="property_type" id="property_type" class="form-select @error('property_type') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
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
                    <div class="col-md-4">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Disponible" {{ old('status') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="Ocupado" {{ old('status') == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Agregar Propiedad</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($propiedades->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($propiedades as $propiedad)
                        <tr>
                            <td>{{ $propiedad->property_id }}</td>
                            <td>{{ $propiedad->address }}</td>
                            <td>{{ $propiedad->city }}</td>
                            <td>{{ $propiedad->property_type }}</td>
                            <td>${{ number_format($propiedad->price, 0, ',', '.') }}</td>
                            <td>{{ $propiedad->status }}</td>
                            <td>
                                <a href="{{ route('empleado.propiedades.edit', $propiedad->property_id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('empleado.propiedades.destroy', $propiedad->property_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No hay propiedades registradas</h4>
        </div>
    @endif
</div>
@endsection