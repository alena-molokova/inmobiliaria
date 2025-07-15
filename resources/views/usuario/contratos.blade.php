@extends('layouts.app')

@section('title', 'Mis Contratos')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mis Contratos</h2>
    
    @if($contratos->count() > 0)
        <div class="row">
            @foreach($contratos as $contrato)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                {{ $contrato->status }}
                            </span>
                            <span class="badge bg-primary">{{ $contrato->contract_type }}</span>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $contrato->propiedad->property_type }}</h5>
                            
                            <p class="card-text mb-2">
                                <strong>📍 {{ $contrato->propiedad->address }}</strong><br>
                                <small class="text-muted">{{ $contrato->propiedad->city }}</small>
                            </p>
                            
                            <div class="mb-3">
                                <h4 class="text-success mb-0">
                                    ${{ number_format($contrato->amount, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">Monto del contrato</small>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <small class="text-muted d-block">Inicio</small>
                                    <strong>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">
                                        @if($contrato->contract_type == 'Alquiler')
                                            Fin
                                        @else
                                            Venta
                                        @endif
                                    </small>
                                    <strong>
                                        {{ is_object($contrato->end_date) ? $contrato->end_date->format('d/m/Y') : $contrato->end_date }}
                                    </strong>
                                </div>
                            </div>
                            
                            @if($contrato->contract_type == 'Alquiler' && $contrato->end_date)
                                @php
                                    $diasRestantes = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($contrato->end_date), false);
                                @endphp
                                
                                @if($diasRestantes > 0)
                                    <div class="mt-3 text-center">
                                        <small class="text-muted">Días restantes</small><br>
                                        <span class="badge bg-{{ $diasRestantes < 30 ? 'warning' : 'info' }}">
                                            {{ $diasRestantes }} días
                                        </span>
                                    </div>
                                @elseif($diasRestantes == 0)
                                    <div class="mt-3 text-center">
                                        <span class="badge bg-warning">Vence hoy</span>
                                    </div>
                                @else
                                    <div class="mt-3 text-center">
                                        <span class="badge bg-danger">Vencido</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <small class="text-muted">
                                Cliente: {{ $contrato->cliente->nombre_completo ?? 'N/A' }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No tienes contratos registrados</h4>
            <p class="text-muted">Cuando tengas contratos activos, aparecerán aquí</p>
            <a href="{{ route('usuario.propiedades') }}" class="btn btn-primary">
                Ver Propiedades Disponibles
            </a>
        </div>
    @endif
    
    @if($contratos->count() > 0)
        <div class="mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumen</h5>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h4 class="text-primary">{{ $contratos->count() }}</h4>
                            <small class="text-muted">Total contratos</small>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-success">{{ $contratos->where('status', 'Activo')->count() }}</h4>
                            <small class="text-muted">Activos</small>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-info">{{ $contratos->where('contract_type', 'Alquiler')->count() }}</h4>
                            <small class="text-muted">Alquileres</small>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-warning">{{ $contratos->where('contract_type', 'Venta')->count() }}</h4>
                            <small class="text-muted">Ventas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection