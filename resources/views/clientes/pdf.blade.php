<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 26px; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f0f0f0; font-weight: bold; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; color: white; }
        .activo { background: #28a745; }
        .inactivo { background: #dc3545; }
        .footer { text-align: center; margin-top: 25px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 11px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Listado de Clientes</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Registrado por</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->direccion ?? 'N/A' }}</td>
                <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                <td>
                    <span class="badge {{ $cliente->estado ? 'activo' : 'inactivo' }}">
                        {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>{{ $cliente->registrado_por ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Tickets © {{ date('Y') }}</p>
    </div>
</body>
</html>
