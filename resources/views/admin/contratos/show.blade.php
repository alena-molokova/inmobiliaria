@extends('layouts.app')

@section('title', 'Detalles de Contrato - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract text-danger"></i>
                        Detalles de Contrato - Administrador
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información del Contrato</h5>
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
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                            {{ $contrato->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Monto:</strong></td>
                                    <td><strong class="text-success">${{ number_format($contrato->amount, 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Inicio:</strong></td>
                                    <td>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }}</td>
                                </tr>
                                @if($contrato->end_date)
                                    <tr>
                                        <td><strong>Fecha de Fin:</strong></td>
                                        <td>{{ is_object($contrato->end_date) ? $contrato->end_date->format('d/m/Y') : $contrato->end_date }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información de las Partes</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Cliente:</strong></td>
                                    <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email del Cliente:</strong></td>
                                    <td>{{ $contrato->cliente->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Propiedad:</strong></td>
                                    <td>{{ $contrato->propiedad->address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Precio de la Propiedad:</strong></td>
                                    <td>${{ number_format($contrato->propiedad->price ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Empleado Responsable:</strong></td>
                                    <td>
                                        @if($contrato->usuario)
                                            {{ $contrato->usuario->first_name }} {{ $contrato->usuario->last_name }}
                                        @else
                                            <span class="text-muted">Sin asignar</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Información del Sistema</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Fecha de Creación:</strong></td>
                                <td>{{ $contrato->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Última Actualización:</strong></td>
                                <td>{{ $contrato->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.contratos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <div>
                            <a href="{{ route('admin.contratos.edit', $contrato->contract_id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('admin.contratos.destroy', $contrato->contract_id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contrato?')">
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