@extends('layouts.app')

@section('title', 'Detalles de Propiedad')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detalles de la Propiedad</h2>

    <div class="card">
        <div class="card-header">
            {{ $propiedad->address }}, {{ $propiedad->city }}
        </div>
        <div class="card-body">
            <p><strong>Tipo:</strong> {{ $propiedad->property_type }}</p>
            <p><strong>Precio:</strong> ${{ number_format($propiedad->price, 0, ',', '.') }}</p>
            <p><strong>Descripción:</strong> {{ $propiedad->description ?? 'N/A' }}</p>
            <p><strong>Estado:</strong> {{ $propiedad->status }}</p>
            <p><strong>Responsable:</strong> {{ $propiedad->empleado->first_name ?? 'N/A' }} {{ $propiedad->empleado->last_name ?? '' }}</p>
            <a href="{{ route('usuario.propiedades') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection