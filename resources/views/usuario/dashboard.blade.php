@extends('layouts.app')
@section('title', 'Panel Usuario')
@section('body-class', 'bg-primary bg-opacity-10')
@section('content')
<main class="container mt-4">
    <section class="mb-4">
        <h2>Bienvenido, {{ auth()->user()->name }}</h2>
    </section>
    <section class="row g-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Propiedades</h5>
                    <p class="card-text">Explora propiedades disponibles.</p>
                    <a href="{{ route('usuario.propiedades') }}" class="btn btn-primary">Ver Propiedades</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Contratos</h5>
                    <p class="card-text">Revisa tus contratos.</p>
                    <a href="{{ route('usuario.contratos') }}" class="btn btn-primary">Ver Contratos</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection