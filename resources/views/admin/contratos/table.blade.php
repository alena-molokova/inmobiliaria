@if($contratos->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Propiedad</th>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contratos as $contrato)
                    <tr>
                        <td>{{ $contrato->contract_id }}</td>
                        <td>{{ $contrato->cliente->nombre_completo ?? 'N/A' }}</td>
                        <td>{{ $contrato->propiedad->address ?? 'N/A' }}, {{ $contrato->propiedad->city ?? 'N/A' }}</td>
                        <td>{{ $contrato->contract_type }}</td>
                        <td>${{ number_format($contrato->amount, 0, ',', '.') }}</td>
                        <td>{{ $contrato->status }}</td>
                        <td>{{ $contrato->start_date }}</td>
                        <td>{{ $contrato->end_date }}</td>
                        <td>
                            <a href="{{ route('admin.contratos.edit', $contrato->contract_id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.contratos.destroy', $contrato->contract_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este contrato?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center py-5">
        <h4 class="text-muted">No hay contratos que coincidan con los criterios</h4>
    </div>
@endif