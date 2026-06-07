<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 26px; }
        .header p { margin: 5px 0; font-size: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f0f0f0; font-weight: bold; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; color: white; }
        .activo { background: #28a745; }
        .inactivo { background: #dc3545; }
        .message { white-space: pre-wrap; line-height: 1.4; }
        .footer { text-align: center; margin-top: 25px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 11px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Listado de Comentarios</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mensaje</th>
                <th>Ticket</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comentarios as $comentario)
            <tr>
                <td>{{ $comentario->id }}</td>
                <td class="message">{{ $comentario->mensaje }}</td>
                <td>{{ $comentario->ticket->titulo ?? 'N/A' }}</td>
                <td>{{ $comentario->usuario?->nombre ?? 'N/A' }} {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}</td>
                <td>{{ $comentario->fecha ?? $comentario->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <span class="badge {{ $comentario->estado ? 'activo' : 'inactivo' }}">
                        {{ $comentario->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Gestión de Tickets © {{ date('Y') }}</p>
    </div>
</body>
</html>
