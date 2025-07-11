@extends('layouts.app')

@section('title', 'Clientes - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users text-danger"></i>
                        Gestión de Clientes - Administrador
                    </h4>
                    <a href="{{ route('admin.clientes.create') }}" class="btn btn-danger">
                        <i class="fas fa-plus"></i> Nuevo Cliente
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
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Contratos</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->client_id }}</td>
                                        <td>{{ $cliente->nombre_completo }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->phone ?? 'No especificado' }}</td>
                                        <td>{{ $cliente->address ?? 'No especificada' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $cliente->contratos_count ?? 0 }}</span>
                                        </td>
                                        <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.clientes.show', $cliente->client_id) }}" 
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.clientes.edit', $cliente->client_id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.clientes.destroy', $cliente->client_id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar este cliente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            No hay clientes registrados
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