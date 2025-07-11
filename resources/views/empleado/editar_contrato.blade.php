@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')
<div class="container mt-5">
    <h2>Editar Contrato</h2>

    <form method="POST" action="{{ route('empleado.updateContrato', $contrato->id) }}">
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
            <input type="date" name="start_date" class="form-control" value="{{ $contrato->start_date }}" required>
            @error('start_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="end_date" class="form-control" value="{{ $contrato->end_date }}" required>
            @error('end_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleado.contratos') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection