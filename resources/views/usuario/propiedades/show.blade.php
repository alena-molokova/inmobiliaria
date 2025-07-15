@extends('layouts.app')

@section('title', 'Detalles de Propiedad')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-home"></i>
                            Detalles de la Propiedad
                        </h4>
                        <a href="{{ route('usuario.propiedades') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-primary mb-3">{{ $propiedad->property_type }}</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>📍 Dirección:</strong>
                                    <p class="mb-1">{{ $propiedad->address }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>🏙️ Ciudad:</strong>
                                    <p class="mb-1">{{ $propiedad->city }}</p>
                                </div>
                            </div>

                            @if($propiedad->description)
                                <div class="mb-3">
                                    <strong>📝 Descripción:</strong>
                                    <p class="mb-1">{{ $propiedad->description }}</p>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>💰 Precio:</strong>
                                    <p class="mb-1 text-success fw-bold">${{ number_format($propiedad->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>📊 Estado:</strong>
                                    <span class="badge bg-success">{{ $propiedad->status }}</span>
                                </div>
                            </div>

                            @if($propiedad->empleado)
                                <div class="mb-3">
                                    <strong>👤 Empleado Asignado:</strong>
                                    <p class="mb-1">{{ $propiedad->empleado->first_name }} {{ $propiedad->empleado->last_name }}</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>📅 Fecha de Publicación:</strong>
                                <p class="mb-1">{{ is_object($propiedad->created_at) ? $propiedad->created_at->format('d/m/Y H:i') : $propiedad->created_at }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Información de Contacto</h6>
                                </div>
                                <div class="card-body">
                                    @if($propiedad->empleado)
                                        <p><strong>Empleado:</strong><br>
                                        {{ $propiedad->empleado->first_name }} {{ $propiedad->empleado->last_name }}</p>
                                        
                                        @if($propiedad->empleado->phone)
                                            <p><strong>Teléfono:</strong><br>
                                            {{ $propiedad->empleado->phone }}</p>
                                        @endif
                                        
                                        @if($propiedad->empleado->email)
                                            <p><strong>Email:</strong><br>
                                            {{ $propiedad->empleado->email }}</p>
                                        @endif
                                    @else
                                        <p class="text-muted">Sin empleado asignado</p>
                                    @endif
                                </div>
                            </div>

                            @if($propiedad->contratos->count() > 0)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Historial de Contratos</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($propiedad->contratos as $contrato)
                                            <div class="border-bottom pb-2 mb-2">
                                                <small class="text-muted">{{ $contrato->contract_type }}</small><br>
                                                <strong>${{ number_format($contrato->amount, 0, ',', '.') }}</strong><br>
                                                <small>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }} - {{ $contrato->end_date ? (is_object($contrato->end_date) ? $contrato->end_date->format('d/m/Y') : $contrato->end_date) : 'Presente' }}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('usuario.propiedades') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver a Propiedades
                            </a>
                            @if($propiedad->empleado && $propiedad->empleado->email)
                                <a href="mailto:{{ $propiedad->empleado->email }}?subject=Consulta sobre propiedad {{ $propiedad->property_id }}" 
                                   class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> Contactar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 