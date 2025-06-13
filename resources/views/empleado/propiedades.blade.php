@extends('layouts.app')

@section('title', 'Gestión de Propiedades')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Propiedades</h2>

    {{-- Formulario para agregar propiedad --}}
    <form class="mb-4" method="POST" action="{{ route('empleado.propiedades.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-2">
                <input type="text" name="address" class="form-control" placeholder="Dirección" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="city" class="form-control" placeholder="Ciudad" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="property_type" class="form-control" placeholder="Tipo" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="price" class="form-control" placeholder="Precio" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="description" class="form-control" placeholder="Descripción">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="disponible">Disponible</option>
                    <option value="vendido">Vendido</option>
                    <option value="alquilado">Alquilado</option>
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-success w-100">Agregar Propiedad</button>
            </div>
        </div>
    </form>

    {{-- Tabla de propiedades --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propiedades as $propiedad)
                <tr>
                    <td>{{ $propiedad->address }}</td>
                    <td>{{ $propiedad->city }}</td>
                    <td>{{ $propiedad->property_type }}</td>
                    <td>{{ $propiedad->price }}</td>
                    <td>{{ $propiedad->description }}</td>
                    <td>{{ ucfirst($propiedad->status) }}</td>
                    <td>
                        <a href="{{ route('empleado.propiedades.edit', ['id' => $propiedad->property_id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleado.propiedades.destroy', ['id' => $propiedad->property_id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar esta propiedad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
