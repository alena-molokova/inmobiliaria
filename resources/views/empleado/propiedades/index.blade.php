@extends('layouts.app')

@section('title', 'Propiedades - Empleado')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-home text-primary"></i>
                        Gestión de Propiedades
                    </h4>
                    <a href="{{ route('empleado.propiedades.create') }}" class="btn btn-primary">
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
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('empleado.propiedades.show', $propiedad->property_id) }}" 
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('empleado.propiedades.edit', $propiedad->property_id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('empleado.propiedades.destroy', $propiedad->property_id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta propiedad?')">
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
                                        <td colspan="7" class="text-center text-muted">
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