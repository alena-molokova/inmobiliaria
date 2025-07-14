@extends('layouts.app')

@section('title', 'Panel Empleado')
@section('body-class', 'bg-success bg-opacity-10')

@section('content')
<main class="container mt-4">
    <section class="mb-4">
        <h2>Bienvenido, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
    </section>

    <section class="row g-4">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Propiedades</h5>
                    <p class="card-text">Gestiona propiedades (CRUD).</p>
                    <a href="{{ route('empleado.propiedades.index') }}" class="btn btn-success">Gestionar Propiedades</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text">Gestiona tus clientes.</p>
                    <a href="{{ route('empleado.clientes.index') }}" class="btn btn-success">Gestionar Clientes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Contratos</h5>
                    <p class="card-text">Gestiona contratos de venta o alquiler.</p>
                    <a href="{{ route('empleado.contratos.index') }}" class="btn btn-success">Gestionar Contratos</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Gestiona usuarios del sistema.</p>
                    <a href="{{ route('empleado.usuarios.index') }}" class="btn btn-success">Gestionar Usuarios</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection