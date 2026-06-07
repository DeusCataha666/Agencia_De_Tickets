<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #{{ $ticket->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; margin: 20px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #222; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 28px; }
        .header p { margin: 5px 0; font-size: 14px; color: #555; }
        .info, .section { margin-bottom: 20px; }
        .info p, .section p { margin: 4px 0; }
        .info-title { font-size: 16px; font-weight: bold; margin-bottom: 10px; }
        .box { padding: 15px; border: 1px solid #ddd; border-radius: 6px; background: #fafafa; }
        .row { display: flex; flex-wrap: wrap; margin-bottom: 10px; }
        .label { width: 180px; font-weight: bold; color: #222; }
        .value { flex: 1; color: #444; }
        .estado { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .estado.activo { background-color: #d4edda; color: #155724; }
        .estado.inactivo { background-color: #f8d7da; color: #721c24; }
        .description { margin-top: 10px; line-height: 1.6; }
        .comments-title { font-size: 16px; font-weight: bold; margin-bottom: 12px; }
        .comment { margin-bottom: 12px; padding: 12px; background: #f7f7f7; border-left: 4px solid #007bff; border-radius: 4px; }
        .comment-header { font-weight: bold; color: #222; margin-bottom: 6px; }
        .comment-date { font-size: 12px; color: #777; }
        .footer { text-align: center; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 12px; font-size: 12px; color: #777; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>TICKET DE SOPORTE</h1>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
        <p>Ticket #{{ $ticket->id }}</p>
    </div>

    <div class="section box">
        <div class="info-title">INFORMACIÓN DEL TICKET</div>
        <div class="row">
            <div class="label">Título:</div>
            <div class="value">{{ $ticket->titulo }}</div>
        </div>
        <div class="row">
            <div class="label">Estado:</div>
            <div class="value">
                <span class="estado {{ $ticket->estado ? 'activo' : 'inactivo' }}">
                    {{ $ticket->estado ? 'Activo' : 'Inactivo' }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="label">Creado:</div>
            <div class="value">{{ $ticket->created_at->format('d/m/Y H:i') }}</div>
        </div>
        @if($ticket->updated_at)
        <div class="row">
            <div class="label">Última actualización:</div>
            <div class="value">{{ $ticket->updated_at->format('d/m/Y H:i') }}</div>
        </div>
        @endif
    </div>

    <div class="section box">
        <div class="info-title">DATOS DEL CLIENTE</div>
        <div class="row">
            <div class="label">Cliente:</div>
            <div class="value">{{ $ticket->cliente->nombre ?? 'N/A' }}</div>
        </div>
        <div class="row">
            <div class="label">Usuario asignado:</div>
            <div class="value">{{ $ticket->usuarioAsignado?->nombre ?? 'Sin asignar' }} {{ $ticket->usuarioAsignado ? '(' . $ticket->usuarioAsignado->tipoUsuario?->nombre_tipo . ')' : '' }}</div>
        </div>
    </div>

    <div class="section box">
        <div class="info-title">DESCRIPCIÓN</div>
        <div class="description">{{ $ticket->descripcion }}</div>
    </div>

    <div class="section box">
        <div class="info-title">HISTORIAL DE ASIGNACIONES</div>
        <table>
            <thead>
                <tr>
                    <th>Usuario Asignado</th>
                    <th>Asignado Por</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ticket->asignaciones as $asignacion)
                <tr>
                    <td>{{ $asignacion->usuario->nombre ?? 'N/A' }} {{ $asignacion->usuario?->tipoUsuario ? '(' . $asignacion->usuario->tipoUsuario->nombre_tipo . ')' : '' }}</td>
                    <td>{{ $asignacion->asignadoPor->name ?? 'N/A' }}</td>
                    <td>{{ $asignacion->fecha_asignacion }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#999;">Sin historial de asignaciones</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($ticket->comentarios && $ticket->comentarios->count() > 0)
    <div class="section box">
        <div class="comments-title">COMENTARIOS</div>
        @foreach($ticket->comentarios as $comentario)
        <div class="comment">
            <div class="comment-header">
                {{ $comentario->usuario?->nombre ?? 'Usuario' }} {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}
                <span class="comment-date">- {{ $comentario->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div>{{ $comentario->mensaje }}</div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        <p>Sistema de Gestión de Tickets © {{ date('Y') }}</p>
    </div>
</body>
</html>
