@extends('layouts.app')

@section('title', 'Gestión de Contratos')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Contratos</h2>

    <form class="mb-4" method="POST" action="{{ route('empleado.contratos.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="cliente" class="form-control" placeholder="Cliente" required></div>
            <div class="col-md-3"><input type="text" name="propiedad" class="form-control" placeholder="Propiedad" required></div>
            <div class="col-md-2"><input type="date" name="inicio" class="form-control" required></div>
            <div class="col-md-2"><input type="date" name="fin" class="form-control" required></div>
            <div class="col-md-2">
                <button class="btn btn-success w-100" type="submit">Agregar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Propiedad</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->cliente }}</td>
                    <td>{{ $contrato->propiedad }}</td>
                    <td>{{ $contrato->inicio }}</td>
                    <td>{{ $contrato->fin }}</td>
                    <td>
                        <a href="{{ route('empleado.contratos.edit', $contrato->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleado.contratos.destroy', $contrato->id) }}" method="POST" class="d-inline">
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
