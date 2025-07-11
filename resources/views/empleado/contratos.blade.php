@extends('layouts.app')

@section('title', 'Gestión de Contratos')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Contratos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulario para agregar contrato --}}
    <form method="POST" action="{{ route('empleado.contratos.store') }}" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <select name="user_id" class="form-control" required>
               <option value="">Seleccionar Cliente</option>
               @foreach($clientes as $cliente)
          <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
            {{ $cliente->first_name }} {{ $cliente->last_name }}
          </option>
         @endforeach
         </select>
         @error('user_id')
        <small class="text-danger">{{ $message }}</small>
          @enderror
            </div>
            <div class="col-md-4">
                <select name="propiedad_id" class="form-control" required>
                    <option value="">Seleccionar Propiedad</option>
                    @foreach($propiedades as $propiedad)
                        <option value="{{ $propiedad->id }}" {{ old('propiedad_id') == $propiedad->id ? 'selected' : '' }}>
                            {{ $propiedad->address }}
                        </option>
                    @endforeach
                </select>
                @error('propiedad_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="submit" class="btn btn-success w-100">Agregar</button>
            </div>
        </div>
    </form>

    {{-- Tabla de contratos --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Propiedad</th>
                <th>Inicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->cliente->first_name ?? 'N/A' }} {{ $contrato->cliente->last_name ?? '' }}</td>
                    <td>{{ $contrato->propiedad->address ?? 'N/A' }}</td>
                    <td>{{ $contrato->start_date }}</td>
                    <td>
                        <a href="{{ route('empleado.contratos.edit', $contrato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleado.contratos.destroy', $contrato->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Seguro que quieres eliminar este contrato?')" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection