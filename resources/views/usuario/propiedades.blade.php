@extends('layouts.app')

@section('title', 'Propiedades Disponibles')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Propiedades Disponibles</h2>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Filtros de búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('usuario.propiedades') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="city" class="form-label">Ciudad</label>
                        <select name="city" id="city" class="form-select">
                            <option value="">Todas las ciudades</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="property_type" class="form-label">Tipo de Propiedad</label>
                        <select name="property_type" id="property_type" class="form-select">
                            <option value="">Todos los tipos</option>
                            @foreach($propertyTypes as $type)
                                <option value="{{ $type }}" {{ request('property_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="price_min" class="form-label">Precio Mínimo</label>
                        <input type="number" name="price_min" id="price_min" class="form-control" 
                               placeholder="0" value="{{ request('price_min') }}" min="0" step="1000">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="price_max" class="form-label">Precio Máximo</label>
                        <input type="number" name="price_max" id="price_max" class="form-control" 
                               placeholder="Sin límite" value="{{ request('price_max') }}" min="0" step="1000">
                    </div>
                    
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="w-100">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        </div>
                    </div>
                </div>
                
                @if(request()->hasAny(['city', 'property_type', 'price_min', 'price_max']))
                    <div class="row mt-2">
                        <div class="col-12">
                            <a href="{{ route('usuario.propiedades') }}" class="btn btn-outline-secondary btn-sm">
                                Limpiar filtros
                            </a>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    @if($propiedades->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($propiedades as $propiedad)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">{{ $propiedad->property_type }}</h5>
                                <span class="badge bg-success">{{ $propiedad->status }}</span>
                            </div>
                            
                            <p class="card-text mb-2">
                                <strong>📍 {{ $propiedad->address }}</strong><br>
                                <small class="text-muted">{{ $propiedad->city }}</small>
                            </p>
                            
                            @if($propiedad->description)
                                <p class="card-text">{{ Str::limit($propiedad->description, 100) }}</p>
                            @endif
                            
                            <div class="mt-auto">
                                <h4 class="text-primary mb-0">
                                    ${{ number_format($propiedad->price, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">
                                    Publicado {{ $propiedad->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-outline-primary btn-sm w-100" disabled>
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $propiedades->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No se encontraron propiedades</h4>
            <p class="text-muted">Prueba modificando los filtros de búsqueda</p>
        </div>
    @endif
</div>
@endsection