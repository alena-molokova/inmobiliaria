@extends('layouts.app')

@section('title', 'Detalles de Cliente - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user text-danger"></i>
                        Detalles de Cliente - Administrador
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $cliente->client_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td>{{ $cliente->nombre_completo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Teléfono:</strong></td>
                                    <td>{{ $cliente->phone ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dirección:</strong></td>
                                    <td>{{ $cliente->address ?? 'No especificada' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Sistema</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Fecha de Registro:</strong></td>
                                    <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contratos:</strong></td>
                                    <td><span class="badge bg-info">{{ $cliente->contratos->count() }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($cliente->contratos->count() > 0)
                        <div class="mt-4">
                            <h5>Contratos del Cliente</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped">
                                    <thead class="table-dark">
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
                                                <td>{{ $contrato->propiedad->address ?? 'N/A' }}</td>
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
                        <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <div>
                            <a href="{{ route('admin.clientes.edit', $cliente->client_id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('admin.clientes.destroy', $cliente->client_id) }}" 
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">
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