@extends('layouts.app')
@section('title', 'Panel Usuario')
@section('body-class', 'bg-primary bg-opacity-10')

@section('content')
<main class="flex-grow-1">
<div class="container mt-5">
  <h2 class="mb-4">Bienvenido, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
  <p>Estas son algunas propiedades que podrían interesarte:</p>

  <h3 class="mb-4">Otras opciones</h3>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title">Propiedades</h5>
          <p class="card-text">Consulta las propiedades disponibles.</p>
          <a href="{{ route('usuario.propiedades') }}" class="btn btn-primary">Ver Propiedades</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title">Contratos</h5>
          <p class="card-text">Visualiza tus contratos vigentes.</p>
          <a href="{{ route('usuario.contratos') }}" class="btn btn-primary">Ver Contratos</a>
        </div>
      </div>
    </div>
  </div>

</div>
</main>
@endsection
