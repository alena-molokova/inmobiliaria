@extends('layouts.app') 

@section('title', 'Gestión de Clientes')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Clientes</h2>

    <form class="mb-4" method="POST" action="{{ route('empleado.clientes.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-4"><input type="text" name="nombre" class="form-control" placeholder="Nombre" required></div>
            <div class="col-md-4"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            <div class="col-md-4">
                <button class="btn btn-success w-100" type="submit">Agregar</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        <a href="{{ route('empleado.clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('empleado.clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
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
