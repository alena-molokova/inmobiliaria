@if($propiedades->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($propiedades as $propiedad)
                    <tr>
                        <td>{{ $propiedad->property_id }}</td>
                        <td>{{ $propiedad->address }}</td>
                        <td>{{ $propiedad->city }}</td>
                        <td>{{ $propiedad->property_type }}</td>
                        <td>${{ number_format($propiedad->price, 0, ',', '.') }}</td>
                        <td>{{ $propiedad->status }}</td>
                        <td>{{ $propiedad->empleado->first_name ?? 'N/A' }} {{ $propiedad->empleado->last_name ?? '' }}</td>
                        <td>
                            <a href="{{ route('admin.propiedades.edit', $propiedad->property_id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.propiedades.destroy', $propiedad->property_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta propiedad?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center py-5">
        <h4 class="text-muted">No hay propiedades que coincidan con los criterios</h4>
    </div>
@endif