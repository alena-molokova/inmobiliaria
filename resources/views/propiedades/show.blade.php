@extends('layouts.app')

@section('title', 'Detalles de Propiedad')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detalles de {{ $propiedad->property_type }}</h2>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $propiedad->address }}</h5>
            <p class="card-text"><strong>Ciudad:</strong> {{ $propiedad->city }}</p>
            <p class="card-text"><strong>Tipo:</strong> {{ $propiedad->property_type }}</p>
            <p class="card-text"><strong>Precio:</strong> ${{ number_format($propiedad->price, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $propiedad->status }}</p>
            @if($propiedad->description)
                <p class="card-text"><strong>Descripción:</strong> {{ $propiedad->description }}</p>
            @endif
            <p class="card-text"><strong>Empleado:</strong> {{ $propiedad->empleado->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Publicado:</strong> {{ $propiedad->created_at->format('d/m/Y H:i') }}</p>
            <a href="{{ route('usuario.propiedades') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection