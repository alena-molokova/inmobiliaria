@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Clientes</h2>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Agregar Cliente</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.clientes.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">Nombre</label>
                        <input type="text" name="first_name" id="first_name" class= "form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">Apellido</label>
                        <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Agregar Cliente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($clientes->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->client_id }}</td>
                            <td>{{ $cliente->nombre_completo }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->phone ?? 'N/A' }}</td>
                            <td>{{ $cliente->address ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('empleado.clientes.edit', $cliente->client_id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('empleado.clientes.destroy', $cliente->client_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">No hay clientes registrados</h4>
        </div>
    @endif
</div>
@endsection