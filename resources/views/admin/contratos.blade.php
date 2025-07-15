@extends('layouts.app')

@section('title', 'Contratos - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-file-contract text-danger"></i>
                        Gestión de Contratos - Administrador
                    </h4>
                    <a href="{{ route('admin.contratos.create') }}" class="btn btn-danger">
                        <i class="fas fa-plus"></i> Nuevo Contrato
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Propiedad</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Empleado</th>
                                    <th>Fecha Inicio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contratos as $contrato)
                                    <tr>
                                        <td>{{ $contrato->contract_id }}</td>
                                        <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
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
                                        <td>
                                            @if($contrato->usuario)
                                                {{ $contrato->usuario->first_name }} {{ $contrato->usuario->last_name }}
                                            @else
                                                <span class="text-muted">Sin asignar</span>
                                            @endif
                                        </td>
                                        <td>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.contratos.show', $contrato->contract_id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                                <a href="{{ route('admin.contratos.edit', $contrato->contract_id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                                <form action="{{ route('admin.contratos.destroy', $contrato->contract_id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contrato?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            No hay contratos registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 