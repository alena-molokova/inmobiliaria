@extends('layouts.app')

@section('title', 'Panel Administrador')
@section('body-class', 'bg-danger bg-opacity-10')

@section('content')
<main class="container mt-4">
    <section class="mb-4">
        <h2>Bienvenido, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
    </section>

    <section class="row g-4">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Gestiona los usuarios registrados.</p>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-danger">Gestionar Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Empleados</h5>
                    <p class="card-text">Gestiona los empleados.</p>
                    <a href="{{ route('admin.empleados') }}" class="btn btn-danger">Gestionar Empleados</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Visualiza reportes y estadísticas.</p>
                    <a href="{{ route('admin.reportes') }}" class="btn btn-danger">Ver Reportes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Propiedades</h5>
                    <p class="card-text">Gestiona propiedades (CRUD).</p>
                    <a href="{{ route('admin.propiedades') }}" class="btn btn-danger">Gestionar Propiedades</a>
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4 mt-5">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text">Gestiona tus clientes.</p>
                    <a href="{{ route('admin.clientes') }}" class="btn btn-danger">Gestionar Clientes</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Contratos</h5>
                    <p class="card-text">Gestiona contratos de venta o alquiler.</p>
                    <a href="{{ route('admin.contratos') }}" class="btn btn-danger">Gestionar Contratos</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection