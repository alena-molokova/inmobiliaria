@extends('layouts.app') 
@extends('layouts.app')

@section('title', 'Gestión de Usuarios Normales')

@section('content')
<div class="container mt-5">
    <h2>Gestión de Clientes</h2>

    <form method="POST" action="{{ route('empleado.clientes.store') }}" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3"><input type="text" name="first_name" class="form-control" placeholder="Nombre" required></div>
            <div class="col-md-3"><input type="text" name="last_name" class="form-control" placeholder="Apellido" required></div>
            <div class="col-md-3"><input type="text" name="phone" class="form-control" placeholder="Teléfono"></div>
            <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
            <div class="col-md-3 mt-2"><input type="password" name="password" class="form-control" placeholder="Contraseña" required></div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-success w-100">Agregar Usuario</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->first_name }}</td>
                    <td>{{ $usuario->last_name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->phone }}</td>
                    <td>
                        <a href="{{ route('empleado.usuarios.edit', ['id' => $usuario->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('empleado.usuarios.destroy', $usuario->id) }}" class="d-inline">
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
