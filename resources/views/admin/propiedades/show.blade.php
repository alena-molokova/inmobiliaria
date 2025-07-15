@extends('layouts.app')

@section('title', 'Detalles de Propiedad - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-home text-danger"></i>
                        Detalles de Propiedad - Administrador
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información Básica</h5>
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
                                    <td><span class="badge bg-info">{{ $propiedad->property_type }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Precio:</strong></td>
                                    <td><strong class="text-success">${{ number_format($propiedad->price, 2) }}</strong></td>
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
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información Adicional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Empleado Asignado:</strong></td>
                                    <td>
                                        @if($propiedad->empleado)
                                            {{ $propiedad->empleado->first_name }} {{ $propiedad->empleado->last_name }}
                                        @else
                                            <span class="text-muted">Sin asignar</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Registro:</strong></td>
                                    <td>{{ $propiedad->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $propiedad->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contratos:</strong></td>
                                    <td><span class="badge bg-info">{{ $propiedad->contratos->count() }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($propiedad->description)
                        <div class="mt-4">
                            <h5>Descripción</h5>
                            <p class="text-muted">{{ $propiedad->description }}</p>
                        </div>
                    @endif

                    @if($propiedad->contratos->count() > 0)
                        <div class="mt-4">
                            <h5>Contratos Relacionados</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Tipo</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Fecha Inicio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($propiedad->contratos as $contrato)
                                            <tr>
                                                <td>{{ $contrato->contract_id }}</td>
                                                <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $contrato->contract_type == 'Venta' ? 'success' : 'info' }}">
                                                        {{ $contrato->contract_type }}
                                                    </span>
                                                </td>
                                                <td>${{ number_format($contrato->amount, 2) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                                        {{ $contrato->status }}
                                                    </span>
                                                </td>
                                                <td>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.propiedades.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <div>
                            <a href="{{ route('admin.propiedades.edit', $propiedad->property_id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('admin.propiedades.destroy', $propiedad->property_id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 