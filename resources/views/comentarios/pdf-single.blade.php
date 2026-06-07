<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentario #{{ $comentario->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 26px; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        .content { margin-bottom: 20px; }
        .content p { margin: 6px 0; }
        .label { font-weight: bold; color: #222; width: 140px; display: inline-block; }
        .message { background: #f7f7f7; padding: 12px; border-left: 4px solid #007bff; border-radius: 4px; margin-top: 10px; }
        .footer { text-align: center; margin-top: 25px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 11px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comentario #{{ $comentario->id }}</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="content">
        <p><span class="label">Ticket:</span> {{ $comentario->ticket->titulo ?? 'N/A' }}</p>
        <p><span class="label">Usuario:</span> {{ $comentario->usuario?->nombre ?? 'N/A' }} {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}</p>
        <p><span class="label">Fecha:</span> {{ $comentario->fecha ?? $comentario->created_at->format('d/m/Y H:i') }}</p>
        <p><span class="label">Estado:</span> {{ $comentario->estado ? 'Activo' : 'Inactivo' }}</p>
    </div>

    <div class="message">
        {{ $comentario->mensaje }}
    </div>

    <div class="footer">
        <p>Sistema de Gestión de Tickets © {{ date('Y') }}</p>
    </div>
</body>
</html>
