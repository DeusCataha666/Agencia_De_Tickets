<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente #{{ $cliente->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 26px; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        .info { margin-bottom: 20px; }
        .info p { margin: 6px 0; }
        .label { font-weight: bold; color: #222; width: 140px; display: inline-block; }
        .tickets { margin-top: 20px; }
        .ticket-item { margin-bottom: 12px; padding: 12px; background: #f7f7f7; border-left: 4px solid #007bff; border-radius: 4px; }
        .footer { text-align: center; margin-top: 25px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 11px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cliente #{{ $cliente->id }}</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info">
        <p><span class="label">Nombre:</span> {{ $cliente->nombre }}</p>
        <p><span class="label">Dirección:</span> {{ $cliente->direccion ?? 'N/A' }}</p>
        <p><span class="label">Teléfono:</span> {{ $cliente->telefono ?? 'N/A' }}</p>
        <p><span class="label">Estado:</span> {{ $cliente->estado ? 'Activo' : 'Inactivo' }}</p>
        <p><span class="label">Registrado por:</span> {{ $cliente->registrado_por ?? 'N/A' }}</p>
    </div>

    <div class="tickets">
        <h2>Tickets asociados</h2>
        @if($cliente->tickets->count())
            @foreach($cliente->tickets as $ticket)
            <div class="ticket-item">
                <strong>{{ $ticket->titulo }}</strong><br>
                <small>ID: {{ $ticket->id }} | Estado: {{ $ticket->estado ? 'Activo' : 'Inactivo' }} | Fecha: {{ $ticket->created_at->format('d/m/Y H:i') }}</small>
            </div>
            @endforeach
        @else
            <p>No hay tickets asociados a este cliente.</p>
        @endif
    </div>

    <div class="footer">
        <p>Sistema de Gestión de Tickets © {{ date('Y') }}</p>
    </div>
</body>
</html>
