@extends('layouts.app')
@section('title', 'Panel Usuario')
@section('body-class', 'bg-primary bg-opacity-10')

@section('content')
<main class="flex-grow-1">
<div class="container mt-5">
  <h2 class="mb-4">Bienvenido, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
  <p>Estas son algunas propiedades que podrían interesarte:</p>

  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card shadow">
        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/492127684.jpg?k=71b1fb328e8c1e96ee6ede9f7c47abe41e0eb08beab6b417ea6d5bd925ac202a&o=&hp=1" class="card-img-top" alt="Departamento moderno en Palermo">
        <div class="card-body">
          <h5 class="card-title">Departamento Moderno en Palermo, CABA</h5>
          <p class="card-text">Departamento moderno de 2 ambientes ubicado en el corazón de Palermo Soho,
             cerca de bares, restaurantes y parques. Ideal para jóvenes profesionales.</p>
          <a href="#" class="btn btn-primary">Ver más</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow">
        <img src="https://imgar.zonapropcdn.com/avisos/1/00/55/97/14/88/360x266/1969145752.jpg?isFirstImage=true" class="card-img-top" alt="Casa San Isidro">
        <div class="card-body">
          <h5 class="card-title">Casa Familiar en San Isidro, Zona Norte</h5>
          <p class="card-text">Amplia casa familiar en San Isidro, a 5 minutos de la estación de tren. 
            Cuenta con 4 dormitorios, jardín, pileta y quincho</p>
          <a href="#" class="btn btn-primary">Ver más</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow">
        <img src="https://www.interpatagonia.com/plantillas/grandes/25441-00Gr.jpg" alt="Cabaña en Villa La Angostura" class="card-img-top">
        <div class="card-body">
          <h5 class="card-title">Cabaña en Villa La Angostura, Patagonia</h5>
          <p class="card-text">Encantadora cabaña de montaña en Villa La Angostura, 
            rodeada de bosques nativos y a pocos minutos del Lago Nahuel Huapi. Ideal para escapadas de fin de semana.</p>
          <a href="#" class="btn btn-primary">Ver más</a>
        </div>
      </div>
    </div>
  </div>

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
