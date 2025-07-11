@extends('layouts.app')

@section('title', 'Detalles de Contrato - Empleado')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract text-primary"></i>
                        Detalles de Contrato #{{ $contrato->contract_id }}
                    </h4>
                    <div>
                        <a href="{{ route('empleado.contratos.edit', $contrato->contract_id) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('empleado.contratos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información del Cliente</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td>{{ $contrato->cliente->nombre_completo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $contrato->cliente->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Teléfono:</strong></td>
                                    <td>{{ $contrato->cliente->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dirección:</strong></td>
                                    <td>{{ $contrato->cliente->address ?? 'No especificada' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Información de la Propiedad</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Dirección:</strong></td>
                                    <td>{{ $contrato->propiedad->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ciudad:</strong></td>
                                    <td>{{ $contrato->propiedad->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipo:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $contrato->propiedad->property_type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Precio:</strong></td>
                                    <td class="h5 text-success">${{ number_format($contrato->propiedad->price, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Detalles del Contrato</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $contrato->contract_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipo:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $contrato->contract_type == 'Venta' ? 'success' : 'info' }}">
                                            {{ $contrato->contract_type }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Monto:</strong></td>
                                    <td class="h5 text-success">${{ number_format($contrato->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                            {{ $contrato->status }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Fechas</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Fecha de Inicio:</strong></td>
                                    <td>{{ $contrato->start_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Fin:</strong></td>
                                    <td>{{ $contrato->end_date ? $contrato->end_date->format('d/m/Y') : 'No especificada' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Duración:</strong></td>
                                    <td>
                                        @if($contrato->end_date)
                                            {{ $contrato->start_date->diffInDays($contrato->end_date) }} días
                                        @else
                                            Sin fecha de fin
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Creación:</strong></td>
                                    <td>{{ $contrato->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($contrato->propiedad->description)
                        <div class="mt-4">
                            <h5 class="text-primary">Descripción de la Propiedad</h5>
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-0">{{ $contrato->propiedad->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Nota:</strong> Este contrato fue creado por el empleado 
                            <strong>{{ auth()->user()->name }}</strong> el {{ $contrato->created_at->format('d/m/Y a las H:i') }}.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 