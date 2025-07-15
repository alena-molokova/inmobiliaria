@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
<div class="container mt-5">
    <h2>Editar Contrato</h2>

    <form method="POST" action="{{ route('empleado.contratos.update', $contrato->contract_id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="">Seleccionar Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->client_id }}" {{ $contrato->client_id == $cliente->client_id ? 'selected' : '' }}>
                        {{ $cliente->first_name }} {{ $cliente->last_name }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Propiedad</label>
            <select name="property_id" class="form-control" required>
                <option value="">Seleccionar Propiedad</option>
                @foreach($propiedades as $propiedad)
                    <option value="{{ $propiedad->property_id }}" {{ $contrato->property_id == $propiedad->property_id ? 'selected' : '' }}>
                        {{ $propiedad->address }}
                    </option>
                @endforeach
            </select>
            @error('property_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', is_object($contrato->start_date) ? $contrato->start_date->format('Y-m-d') : $contrato->start_date) }}" required>
            @error('start_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', is_object($contrato->end_date) ? $contrato->end_date->format('Y-m-d') : $contrato->end_date) }}" required>
            @error('end_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleado.contratos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection