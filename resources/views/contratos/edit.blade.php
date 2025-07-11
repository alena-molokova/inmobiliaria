@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Contrato</h2>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('empleado.contratos.update', $contrato->contract_id) }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->client_id }}" {{ $contrato->user_id == $cliente->client_id ? 'selected' : '' }}>
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
                                <option value="{{ $cliente->client_id }}" {{ $contrato->client_id == $cliente->client_id ? 'selected' : '' }}>
                                    {{ $cliente->nombre_completo }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="invalidertiary

System: invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="property_id" class="form-label">Propiedad</label>
                        <select name="property_id" id="property_id" class="form-select @error('property_id') is-invalid @enderror" required>
                            <option value="">Seleccionar</option>
                            @foreach($propiedades as $propiedad)
                                <option value="{{ $propiedad->property_id }}" {{ $contrato->property_id == $propiedad->property_id ? 'selected' : '' }}>
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
                            <option value="Alquiler" {{ $contrato->contract_type == 'Alquiler' ? 'selected' : '' }}>Alquiler</option>
                            <option value="Venta" {{ $contrato->contract_type == 'Venta' ? 'selected' : '' }}>Venta</option>
                        </select>
                        @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $contrato->start_date) }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Fecha de Fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $contrato->end_date) }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label">Monto</label>
                        <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $contrato->amount) }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="Activo" {{ $contrato->status == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Finalizado" {{ $contrato->status == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar Contrato</button>
                        <a href="{{ route('empleado.contratos') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection