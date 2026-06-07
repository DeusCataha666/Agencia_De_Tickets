@extends('layouts.app')

@section('title', 'Ver Ticket - ' . $ticket->titulo)

@section('content')
<div class="mb-4">
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary btn-sm mb-3">
        <i class="fas fa-arrow-left me-2"></i>Volver
    </a>
    <h1 class="page-title mb-0">
        <i class="fas fa-ticket-alt me-2"></i>{{ $ticket->titulo }}
    </h1>
    <small class="text-muted">Ticket #{{ $ticket->id }} - Creado el {{ $ticket->fecha_creacion->format('d/m/Y H:i') }}</small>
</div>

<div class="row">
    <!-- Información Principal -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Información del Ticket
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Cliente:</strong>
                        <p>{{ $ticket->cliente->nombre ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Estado:</strong>
                        <p>
                            <span class="badge bg-{{ $ticket->estado == 1 ? 'success' : 'danger' }} fs-6">
                                {{ $ticket->estado == 1 ? 'Abierto' : 'Cerrado' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Sector Actual:</strong>
                        <p><span class="badge bg-info">{{ $ticket->sector ?? 'Sin asignar' }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Asignado a:</strong>
                        <p>{{ $ticket->usuarioAsignado->nombre ?? 'Sin asignar' }}</p>
                    </div>
                </div>

                <hr>

                <strong>Descripción:</strong>
                <div class="bg-light p-3 rounded mb-3">
                    {{ $ticket->descripcion }}
                </div>

                @if($ticket->imagen)
                    <strong>Imagen del Ticket:</strong>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $ticket->imagen) }}" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                @endif
            </div>
        </div>

        <!-- Historial de Cambios -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-history me-2"></i>Historial de Cambios
            </div>
            <div class="card-body">
                @if($ticket->historiales->count() > 0)
                    <div class="timeline">
                        @foreach($ticket->historiales as $historial)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $historial->usuario->nombre ?? 'Sistema' }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $historial->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    @if($historial->estado_anterior || $historial->estado_nuevo)
                                        <p class="mb-1">
                                            <i class="fas fa-exchange-alt me-2 text-info"></i>
                                            Estado: <strong>{{ $historial->estado_anterior ?? 'N/A' }}</strong> → <strong>{{ $historial->estado_nuevo ?? 'N/A' }}</strong>
                                        </p>
                                    @endif
                                    @if($historial->sector_anterior || $historial->sector_nuevo)
                                        <p class="mb-1">
                                            <i class="fas fa-arrows-alt-h me-2 text-warning"></i>
                                            Sector: <strong>{{ $historial->sector_anterior ?? 'N/A' }}</strong> → <strong>{{ $historial->sector_nuevo ?? 'N/A' }}</strong>
                                        </p>
                                    @endif
                                    @if($historial->motivo)
                                        <p class="mb-0 text-muted">
                                            <i class="fas fa-quote-left me-2"></i>{{ $historial->motivo }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center py-3">
                        <i class="fas fa-info-circle me-2"></i>No hay cambios registrados
                    </p>
                @endif
            </div>
        </div>

        <!-- Comentarios -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-comments me-2"></i>Comentarios ({{ $ticket->comentarios->count() }})
            </div>
            <div class="card-body">
                @forelse($ticket->comentarios as $comentario)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $comentario->usuario->nombre ?? 'Usuario' }}</strong>
                            <small class="text-muted">{{ $comentario->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <p class="mt-2 mb-2">{{ $comentario->mensaje }}</p>
                        @if($comentario->imagen)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $comentario->imagen) }}" class="img-fluid rounded" style="max-height: 200px;">
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted text-center py-4">
                        <i class="fas fa-comments"></i> Sin comentarios
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Panel Lateral -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-cog me-2"></i>Acciones
            </div>
            <div class="card-body">
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning w-100 mb-2">
                    <i class="fas fa-edit me-2"></i>Editar Ticket
                </a>
                <a href="{{ route('tickets.viewPdf', $ticket->id) }}" class="btn btn-danger w-100 mb-2">
                    <i class="fas fa-file-pdf me-2"></i>Ver PDF
                </a>
                <a href="{{ route('comentarios.create') }}" class="btn btn-primary w-100">
                    <i class="fas fa-plus me-2"></i>Añadir Comentario
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-bar-chart me-2"></i>Estadísticas
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="d-flex justify-content-between">
                        <span>Comentarios:</span>
                        <span class="badge bg-info">{{ $ticket->comentarios->count() }}</span>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="d-flex justify-content-between">
                        <span>Cambios registrados:</span>
                        <span class="badge bg-warning">{{ $ticket->historiales->count() }}</span>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="d-flex justify-content-between">
                        <span>Asignaciones:</span>
                        <span class="badge bg-primary">{{ $ticket->asignaciones->count() }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
