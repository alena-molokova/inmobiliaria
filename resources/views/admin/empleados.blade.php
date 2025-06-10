@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Gestión de Empleados</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->name }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->role->role_name }}</td>
                    <td>
                        <a href="{{ route('admin.empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.empleados.destroy', $empleado->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este empleado?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <h4>Agregar Nuevo Empleado</h4>
        <form action="{{ route('admin.empleados.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input name="name" type="text" class="form-control" placeholder="Nombre del empleado">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Correo electrónico">
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="role" class="form-select">
                    <option value="Empleado">Empleado</option>
                    <option value="Administrador">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
</div>
@endsection
