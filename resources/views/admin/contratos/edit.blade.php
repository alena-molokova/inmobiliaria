@extends('layouts.app')

@section('title', 'Editar Contrato - Administrador')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit text-danger"></i>
                        Editar Contrato - Administrador
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contratos.update', $contrato->contract_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="client_id" class="form-label">Cliente *</label>
                                <select class="form-select @error('client_id') is-invalid @enderror" 
                                        id="client_id" name="client_id" required>
                                    <option value="">Seleccionar cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->client_id }}" 
                                                {{ old('client_id', $contrato->client_id) == $cliente->client_id ? 'selected' : '' }}>
                                            {{ $cliente->nombre_completo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="property_id" class="form-label">Propiedad *</label>
                                <select class="form-select @error('property_id') is-invalid @enderror" 
                                        id="property_id" name="property_id" required>
                                    <option value="">Seleccionar propiedad</option>
                                    @foreach($propiedades as $propiedad)
                                        <option value="{{ $propiedad->property_id }}" 
                                                {{ old('property_id', $contrato->property_id) == $propiedad->property_id ? 'selected' : '' }}>
                                            {{ $propiedad->address }} - ${{ number_format($propiedad->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contract_type" class="form-label">Tipo de Contrato *</label>
                                <select class="form-select @error('contract_type') is-invalid @enderror" 
                                        id="contract_type" name="contract_type" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="Alquiler" {{ old('contract_type', $contrato->contract_type) == 'Alquiler' ? 'selected' : '' }}>Alquiler</option>
                                    <option value="Venta" {{ old('contract_type', $contrato->contract_type) == 'Venta' ? 'selected' : '' }}>Venta</option>
                                </select>
                                @error('contract_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Estado *</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="Activo" {{ old('status', $contrato->status) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Pendiente" {{ old('status', $contrato->status) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Terminado" {{ old('status', $contrato->status) == 'Terminado' ? 'selected' : '' }}>Terminado</option>
                                    <option value="Cancelado" {{ old('status', $contrato->status) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Fecha de Inicio *</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" 
                                       value="{{ old('start_date', $contrato->start_date->format('Y-m-d')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" 
                                       value="{{ old('end_date', $contrato->end_date ? $contrato->end_date->format('Y-m-d') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="amount" class="form-label">Monto *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" value="{{ old('amount', $contrato->amount) }}" required>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Empleado Responsable *</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" 
                                        id="user_id" name="user_id" required>
                                    <option value="">Seleccionar empleado</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->user_id }}" 
                                                {{ old('user_id', $contrato->user_id) == $empleado->user_id ? 'selected' : '' }}>
                                            {{ $empleado->first_name }} {{ $empleado->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.contratos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save"></i> Actualizar Contrato
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 