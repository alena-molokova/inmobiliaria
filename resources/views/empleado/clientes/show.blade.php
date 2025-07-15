@extends('layouts.app')

@section('title', 'Detalles de Cliente - Empleado')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user text-primary"></i>
                        Detalles de Cliente
                    </h4>
                    <div>
                        <a href="{{ route('empleado.clientes.edit', $cliente->client_id) }}" 
                           class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('empleado.clientes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $cliente->client_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td>{{ $cliente->first_name }} {{ $cliente->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Teléfono:</strong></td>
                                    <td>{{ $cliente->phone ?? 'No especificado' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Adicional</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Dirección:</strong></td>
                                    <td>{{ $cliente->address ?? 'No especificada' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Registro:</strong></td>
                                    <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($cliente->contratos && $cliente->contratos->count() > 0)
                        <div class="mt-4">
                            <h5 class="text-primary">Contratos del Cliente</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Propiedad</th>
                                            <th>Tipo</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Fecha Inicio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cliente->contratos as $contrato)
                                            <tr>
                                                <td>{{ $contrato->contract_id }}</td>
                                                <td>{{ $contrato->propiedad->address }}</td>
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
                    @else
                        <div class="mt-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Este cliente no tiene contratos registrados.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 