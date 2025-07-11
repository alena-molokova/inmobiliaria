@extends('layouts.app')

@section('title', 'Contratos')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Contratos</h2>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Agregar Contrato</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.contratos.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->client_id }}" {{ old('user_id') == $cliente->client_id ? 'selected' : '' }}>
                                    {{ $cliente->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="client_id" class="form-label">Cliente</label>
                        <select name="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->client_id }}" {{ old('client_id') == $cliente->client_id ? 'selected' : '' }}>
                                    {{ $cliente->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="property_id" class="form-label">Propiedad</label>
                        <select name="property_id" id="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            @foreach($propiedades as $propiedad)
                                <option value="{{ $propiedad->property_id }}" {{ old('property_id') == $propiedad->property_id ? 'selected' : '' }}>
                                    {{ $propiedad->address }} ({{ $propiedad->city }})
                                </option>
                            @endforeach
                        </select>
                        @error('property_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="contract_type" class="form-label">Tipo de Contrato</label>
                        <select name="contract_type" id="contract_type" class="form-select @error('contract_type') is-invalid @enderror" required>
                            <option value="Alquiler" {{ old('contract_type') == 'Alquiler' ? 'selected' : '' }}>Alquiler</option>
                            <option value="Venta" {{ old('contract_type') == 'Venta' ? 'selected' : '' }}>Venta</option>
                        </select>
                        @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Fecha de Fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label">Monto</label>
                        <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Finalizado" {{ old('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Agregar Contrato</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if($contratos->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Propiedad</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contratos as $contrato)
                        <tr>
                            <td>{{ $contrato->contract_id }}</td>
                            <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
                            <td>{{ $contrato->propiedad->address }} ({{ $contrato->propiedad->city }})</td>
                            <td>{{ $contrato->contract_type }}</td>
                            <td>${{ number_format($contrato->amount, 0, ',', '.') }}</td>
                            <td>{{ $contrato->status }}</td>
                            <td>
                                <a href="{{ route('empleado.contratos.edit', $contrato->contract_id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('empleado.contratos.destroy', $contrato->contract_id) }}" method="POST" style="display:inline;">
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
            <h4 class="text-muted">No hay contratos registrados</h4>
        </div>
    @endif
</div>
@endsection