<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inmobiliaria Tu Sueño')</title>
    @yield('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">Inmobiliaria Tu Sueño</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @php
                                $roleName = auth()->user()->role->role_name;
                            @endphp

                            <li class="nav-item">
                                @if ($roleName === 'Administrador')
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                @elseif ($roleName === 'Empleado')
                                    <a class="nav-link" href="{{ route('empleado.dashboard') }}">Dashboard</a>
                                @elseif ($roleName === 'Usuario')
                                    <a class="nav-link" href="{{ route('usuario.dashboard') }}">Dashboard</a>
                                @endif
                            </li>

                            @if ($roleName === 'Administrador')
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.usuarios.index') }}">Usuarios</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.empleados.index') }}">Empleados</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.reportes') }}">Reportes</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.propiedades.index') }}">Propiedades</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.clientes.index') }}">Clientes</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.contratos.index') }}">Contratos</a></li>
                            @elseif ($roleName === 'Empleado')
                                <li class="nav-item"><a class="nav-link" href="{{ route('empleado.propiedades.index') }}">Propiedades</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('empleado.clientes.index') }}">Clientes</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('empleado.contratos.index') }}">Contratos</a></li>
                            @elseif ($roleName === 'Usuario')
                                <li class="nav-item"><a class="nav-link" href="{{ route('usuario.propiedades') }}">Propiedades</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('usuario.contratos') }}">Contratos</a></li>
                            @endif

                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Cerrar sesión</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <p>Inmobiliaria Tu Sueño<br>
        📍 Av. 9 de Julio, Buenos Aires<br>
        📞 (2284) 314888<br>
        ✉️ <a href="mailto:[email protected]">[email protected]</a></p>
        <p>© 2025 Inmobiliaria Tu Sueño — Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
