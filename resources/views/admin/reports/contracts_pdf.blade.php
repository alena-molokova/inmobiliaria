<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Contratos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Contratos</h1>
    <table>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>