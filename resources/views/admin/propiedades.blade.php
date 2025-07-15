@extends('layouts.app')

@section('title', 'Propiedades - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-home text-danger"></i>
                        Gestión de Propiedades - Administrador
                    </h4>
                    <a href="{{ route('admin.propiedades.create') }}" class="btn btn-danger">
                        <i class="fas fa-plus"></i> Nueva Propiedad
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
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Tipo</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Empleado Asignado</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($propiedades as $propiedad)
                                    <tr>
                                        <td>{{ $propiedad->property_id }}</td>
                                        <td>{{ $propiedad->address }}</td>
                                        <td>{{ $propiedad->city }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $propiedad->property_type }}</span>
                                        </td>
                                        <td>${{ number_format($propiedad->price, 2) }}</td>
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
                                        <td>
                                            @if($propiedad->empleado)
                                                {{ $propiedad->empleado->first_name }} {{ $propiedad->empleado->last_name }}
                                            @else
                                                <span class="text-muted">Sin asignar</span>
                                            @endif
                                        </td>
                                        <td>{{ $propiedad->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.propiedades.show', $propiedad->property_id) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                                <a href="{{ route('admin.propiedades.edit', $propiedad->property_id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                                <form action="{{ route('admin.propiedades.destroy', $propiedad->property_id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?')">
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
                                            No hay propiedades registradas
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