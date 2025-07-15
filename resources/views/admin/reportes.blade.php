@extends('layouts.app')

@section('title', 'Reportes del Sistema')

@section('head')
<meta name="language" content="es">
<meta name="date-format" content="dd/mm/yyyy">
@endsection

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-chart-bar text-primary"></i> Reportes del Sistema</h2>
                <a href="{{ route('admin.reportes.exportar', request()->query()) }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Exportar a CSV
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter"></i> Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reportes') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                           value="{{ $fechaInicio }}" lang="es" data-date-format="dd/mm/yyyy">
                </div>
                <div class="col-md-3">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                           value="{{ $fechaFin }}" lang="es" data-date-format="dd/mm/yyyy">
                </div>
                <div class="col-md-2">
                    <label for="tipo_contrato" class="form-label">Tipo Contrato</label>
                    <select class="form-select" id="tipo_contrato" name="tipo_contrato">
                        <option value="">Todos</option>
                        @foreach($tiposContrato as $tipo)
                            <option value="{{ $tipo }}" {{ $tipoContrato == $tipo ? 'selected' : '' }}>
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <select class="form-select" id="ciudad" name="ciudad">
                        <option value="">Todas</option>
                        @foreach($ciudades as $ciudadItem)
                            <option value="{{ $ciudadItem }}" {{ $ciudad == $ciudadItem ? 'selected' : '' }}>
                                {{ $ciudadItem }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Estado</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Todos</option>
                        @foreach($statuses as $statusItem)
                            <option value="{{ $statusItem }}" {{ $status == $statusItem ? 'selected' : '' }}>
                                {{ $statusItem }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.reportes') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Limpiar Filtros
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Estadísticas Generales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['totalUsuarios'] }}</h4>
                            <small>Usuarios</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['totalEmpleados'] }}</h4>
                            <small>Empleados</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['totalContratos'] }}</h4>
                            <small>Contratos</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-file-contract fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $stats['totalPropiedades'] }}</h4>
                            <small>Propiedades</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Detalladas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Contratos por Tipo</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h3 class="text-primary">{{ $stats['contratosAlquiler'] }}</h3>
                            <small class="text-muted">Alquileres</small>
                        </div>
                        <div class="col-6">
                            <h3 class="text-success">{{ $stats['contratosVenta'] }}</h3>
                            <small class="text-muted">Ventas</small>
                        </div>
                    </div>
                    @if(isset($stats['promedioContratos']))
                        <div class="mt-3 text-center">
                            <small class="text-muted">Promedio por contrato: ${{ number_format($stats['promedioContratos'], 0, ',', '.') }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Propiedades por Estado</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-3">
                            <h4 class="text-success">{{ $stats['propiedadesDisponibles'] }}</h4>
                            <small class="text-muted">Disponibles</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-primary">{{ $stats['propiedadesVendidas'] }}</h4>
                            <small class="text-muted">Vendidas</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-info">{{ $stats['propiedadesAlquiladas'] }}</h4>
                            <small class="text-muted">Alquiladas</small>
                        </div>
                        <div class="col-3">
                            <h4 class="text-warning">{{ $stats['totalPropiedades'] - $stats['propiedadesDisponibles'] - $stats['propiedadesVendidas'] - $stats['propiedadesAlquiladas'] }}</h4>
                            <small class="text-muted">Otros</small>
                        </div>
                    </div>
                    @if(isset($stats['promedioPrecios']))
                        <div class="mt-3 text-center">
                            <small class="text-muted">Precio promedio: ${{ number_format($stats['promedioPrecios'], 0, ',', '.') }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas por Ciudad -->
    @if($statsPorCiudad->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Estadísticas por Ciudad</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ciudad</th>
                                <th>Cantidad</th>
                                <th>Precio Promedio</th>
                                <th>Disponibles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statsPorCiudad as $ciudad => $stats)
                                <tr>
                                    <td><strong>{{ $ciudad }}</strong></td>
                                    <td>{{ $stats['cantidad'] }}</td>
                                    <td>${{ number_format($stats['promedio_precio'], 0, ',', '.') }}</td>
                                    <td>{{ $stats['disponibles'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Actividad de Empleados -->
    @if($actividadEmpleados->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-tie"></i> Actividad de Empleados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Propiedades Asignadas</th>
                                <th>Contratos Creados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actividadEmpleados as $empleado)
                                <tr>
                                    <td><strong>{{ $empleado['nombre'] }}</strong></td>
                                    <td>{{ $empleado['propiedades_asignadas'] }}</td>
                                    <td>{{ $empleado['contratos_creados'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de Contratos -->
    @if($contratos->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-file-contract"></i> Contratos ({{ $contratos->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <th>Propiedad</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->contract_id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $contrato->contract_type == 'Venta' ? 'success' : 'info' }}">
                                            {{ $contrato->contract_type }}
                                        </span>
                                    </td>
                                    <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
                                    <td>{{ $contrato->propiedad->address ?? 'N/A' }}</td>
                                    <td>${{ number_format($contrato->amount, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $contrato->status == 'Activo' ? 'success' : 'secondary' }}">
                                            {{ $contrato->status }}
                                        </span>
                                    </td>
                                    <td>{{ is_object($contrato->start_date) ? $contrato->start_date->format('d/m/Y') : $contrato->start_date }}</td>
                                    <td>{{ is_object($contrato->end_date) ? $contrato->end_date->format('d/m/Y') : $contrato->end_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de Propiedades -->
    @if($propiedades->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-home"></i> Propiedades ({{ $propiedades->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Empleado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($propiedades as $propiedad)
                                <tr>
                                    <td>{{ $propiedad->property_id }}</td>
                                    <td>{{ $propiedad->property_type }}</td>
                                    <td>{{ $propiedad->address }}</td>
                                    <td>{{ $propiedad->city }}</td>
                                    <td>${{ number_format($propiedad->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $propiedad->status == 'Disponible' ? 'success' : ($propiedad->status == 'Vendido' ? 'primary' : 'info') }}">
                                            {{ $propiedad->status }}
                                        </span>
                                    </td>
                                    <td>{{ $propiedad->empleado ? $propiedad->empleado->first_name . ' ' . $propiedad->empleado->last_name : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Tabla de Clientes -->
    @if($clientes->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-users"></i> Clientes ({{ $clientes->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Contratos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->cliente_id }}</td>
                                    <td>{{ $cliente->nombre_completo }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->phone ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $cliente->contratos_count }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    
    if (fechaInicio) {
        fechaInicio.setAttribute('lang', 'es');
        fechaInicio.setAttribute('data-date-format', 'dd/mm/yyyy');
        fechaInicio.style.setProperty('--date-format', 'dd/mm/yyyy');
    }
    
    if (fechaFin) {
        fechaFin.setAttribute('lang', 'es');
        fechaFin.setAttribute('data-date-format', 'dd/mm/yyyy');
        fechaFin.style.setProperty('--date-format', 'dd/mm/yyyy');
    }
    
    const style = document.createElement('style');
    style.textContent = `
        input[type="date"][lang="es"]::-webkit-calendar-picker-indicator {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>') no-repeat;
            background-size: 16px;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit {
            color: #495057;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit-fields-wrapper {
            color: #495057;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit-text {
            color: #495057;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit-month-field {
            color: #495057;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit-day-field {
            color: #495057;
        }
        
        input[type="date"][lang="es"]::-webkit-datetime-edit-year-field {
            color: #495057;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
