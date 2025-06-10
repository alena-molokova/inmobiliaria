@extends('layouts.app')

@section('title', 'Gestión de Propiedades')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Propiedades</h2>

    <form class="mb-4" method="POST" action="{{ route('empleado.propiedades.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="direccion" class="form-control" placeholder="Dirección" required></div>
            <div class="col-md-3"><input type="text" name="precio" class="form-control" placeholder="Precio" required></div>
            <div class="col-md-3"><input type="text" name="tipo" class="form-control" placeholder="Tipo" required></div>
            <div class="col-md-3">
                <button class="btn btn-success w-100" type="submit">Agregar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dirección</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($propiedades as $propiedad)
                <tr>
                    <td>{{ $propiedad->direccion }}</td>
                    <td>{{ $propiedad->precio }}</td>
                    <td>{{ $propiedad->tipo }}</td>
                    <td>
                        <a href="{{ route('empleado.propiedades.edit', $propiedad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleado.propiedades.destroy', $propiedad->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
