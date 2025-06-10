@extends('layouts.app')

@section('title', 'Contratos Vigentes')

@section('content')
<div class="container mt-5">
    <h2>Contratos Vigentes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Propiedad</th>
                <th>Tipo</th>
                <th>Inicio</th>
                <th>Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->propiedad }}</td>
                    <td>{{ $contrato->tipo }}</td>
                    <td>{{ $contrato->inicio }}</td>
                    <td>{{ $contrato->fin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
