@extends('layouts.app')

@section('title', 'Detalles de Propiedad - Empleado')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-home text-primary"></i>
                        Detalles de Propiedad
                    </h4>
                    <div>
                        <a href="{{ route('empleado.propiedades.edit', $propiedad->property_id) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('empleado.propiedades.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Básica</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $propiedad->property_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dirección:</strong></td>
                                    <td>{{ $propiedad->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ciudad:</strong></td>
                                    <td>{{ $propiedad->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipo:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $propiedad->property_type }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Comercial</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Precio:</strong></td>
                                    <td class="h5 text-success">${{ number_format($propiedad->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        @switch($propiedad->status)
                                            @case('Disponible')
                                                <span class="badge bg-success">{{ $propiedad->status }}</span>
                                                @break
                                            @case('Vendido')
                                                <span class="badge bg-danger">{{ $propiedad->status }}</span>
                                                @break
                                            @case('Alquilado')
                                                <span class="badge bg-warning">{{ $propiedad->status }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $propiedad->status }}</span>
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Registro:</strong></td>
                                    <td>{{ $propiedad->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $propiedad->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($propiedad->description)
                        <div class="mt-4">
                            <h5 class="text-primary">Descripción</h5>
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-0">{{ $propiedad->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($propiedad->empleado)
                        <div class="mt-4">
                            <h5 class="text-primary">Empleado Asignado</h5>
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-0">
                                        <i class="fas fa-user"></i>
                                        {{ $propiedad->empleado->first_name }} {{ $propiedad->empleado->last_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($propiedad->contratos && $propiedad->contratos->count() > 0)
                        <div class="mt-4">
                            <h5 class="text-primary">Contratos Relacionados</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Tipo</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($propiedad->contratos as $contrato)
                                            <tr>
                                                <td>{{ $contrato->contract_id }}</td>
                                                <td>{{ $contrato->cliente->nombre_completo }}</td>
                                                <td>{{ $contrato->contract_type }}</td>
                                                <td>${{ number_format($contrato->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                                        {{ $contrato->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 