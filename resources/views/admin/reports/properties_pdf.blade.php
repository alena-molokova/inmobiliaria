<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Propiedades</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Propiedades</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Responsable</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>