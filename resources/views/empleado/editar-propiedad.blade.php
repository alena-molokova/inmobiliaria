<form method="POST" action="{{ route('empleado.propiedades.update', $propiedad->property_id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text" name="address" class="form-control" value="{{ $propiedad->address }}" required>
    </div>

    <div class="mb-3">
        <label>Ciudad</label>
        <input type="text" name="city" class="form-control" value="{{ $propiedad->city }}" required>
    </div>

    <div class="mb-3">
        <label>Tipo</label>
        <input type="text" name="property_type" class="form-control" value="{{ $propiedad->property_type }}" required>
    </div>

    <div class="mb-3">
        <label>Precio</label>
        <input type="number" name="price" class="form-control" value="{{ $propiedad->price }}" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control">{{ $propiedad->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="status" class="form-control">
            <option value="disponible" {{ $propiedad->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
            <option value="vendido" {{ $propiedad->status == 'vendido' ? 'selected' : '' }}>Vendido</option>
            <option value="alquilado" {{ $propiedad->status == 'alquilado' ? 'selected' : '' }}>Alquilado</option>
        </select>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('empleado.propiedades') }}" class="btn btn-secondary">Volver</a>
</form>
