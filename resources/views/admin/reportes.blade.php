@extends('layouts.app')

@section('title', 'Reportes del Sistema')

@section('content')
<div class="container mt-5">
    <h2>Reportes del Sistema</h2>
    <ul class="list-group">
        <li class="list-group-item">Usuarios registrados: {{ $totalUsuarios }}</li>
        <li class="list-group-item">Empleados registrados: {{ $totalEmpleados }}</li>
        <li class="list-group-item">Administradores registrados: {{ $totalAdmins }}</li>
    </ul>
</div>
@endsection
