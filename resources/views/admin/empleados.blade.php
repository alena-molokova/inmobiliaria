@extends('layouts.app')

@section('title', 'Gestión de Empleados - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users text-danger"></i>
                        Gestión de Empleados - Administrador
                    </h4>
                    <a href="{{ route('admin.empleados.create') }}" class="btn btn-danger">
                        <i class="fas fa-plus"></i> Nuevo Empleado
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
                <th>Rol</th>
                                    <th>Fecha Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
                                @forelse($empleados as $empleado)
                <tr>
                                        <td>{{ $empleado->user_id }}</td>
                                        <td>{{ $empleado->first_name }} {{ $empleado->last_name }}</td>
                    <td>{{ $empleado->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $empleado->role->role_name == 'Administrador' ? 'danger' : 'info' }}">
                                                {{ $empleado->role->role_name }}
                                            </span>
                                        </td>
                                        <td>{{ $empleado->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.empleados.show', $empleado->user_id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                                <a href="{{ route('admin.empleados.edit', $empleado->user_id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                                <form action="{{ route('admin.empleados.destroy', $empleado->user_id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este empleado?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="fas fa-info-circle"></i>
                                            No hay empleados registrados
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
