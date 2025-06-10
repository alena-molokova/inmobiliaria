@extends('layouts.app')

@section('title', 'Propiedades Disponibles')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Propiedades Disponibles</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($propiedades as $propiedad)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $propiedad->imagen }}" class="card-img-top" alt="{{ $propiedad->titulo }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $propiedad->titulo }}</h5>
                        <p class="card-text">{{ $propiedad->descripcion }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
