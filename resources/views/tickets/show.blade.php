@extends('layouts.app')

@section('title','Ver Ticket')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary" style="font-size:1.75rem;font-weight:600;line-height:1.2;margin-bottom:0;color:white;">
                            Ticket #{{ $ticket->id }} - {{ $ticket->titulo }}
                        </div>
                        <div class="card-body">
                            <!-- Información Principal -->
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Cliente</label>
                                        <p style="font-size: 1.1rem; color: var(--dark);">{{ $ticket->cliente->nombre ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Estado</label>
                                        <p>
                                            <span class="badge" style="background-color: {{ $ticket->estado ? '#10B981' : '#EF4444' }}; padding: 0.5rem 1rem; font-size: 0.9rem;">
                                                {{ $ticket->estado ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Usuario Asignado</label>
                                        <p style="font-size: 1rem;">
                                            @if($ticket->usuarioAsignado)
                                                <span class="badge" style="background-color: var(--primary); padding: 0.5rem 1rem;">
                                                    {{ $ticket->usuarioAsignado->nombre }}
                                                    {{ $ticket->usuarioAsignado->tipoUsuario ? '(' . $ticket->usuarioAsignado->tipoUsuario->nombre_tipo . ')' : '' }}
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #94A3B8; padding: 0.5rem 1rem;">Sin asignar</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Sector</label>
                                        <p style="font-size: 1rem;">{{ $ticket->sector ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Fecha de Creación</label>
                                        <p style="font-size: 1rem;">{{ $ticket->fecha_creacion ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Fecha de Cierre</label>
                                        <p style="font-size: 1rem;">{{ $ticket->fecha_cierre ?? 'Aún abierto' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Descripción</label>
                                        <p style="font-size: 1rem; line-height: 1.6; background-color: var(--light); padding: 1rem; border-radius: 0.5rem;">{{ $ticket->descripcion ?? 'Sin descripción' }}</p>
                                    </div>
                                </div>
                                @if($ticket->imagen)
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label" style="font-weight: 600; color: #1E293B;">Imagen Adjunta</label><br>
                                        <img src="{{ asset('storage/' . $ticket->imagen) }}" alt="Imagen del ticket" style="max-width:100%; max-height: 300px; border-radius:8px; border: 2px solid #E2E8F0; margin-top: 0.5rem;">
                                    </div>
                                </div>
                                @endif
                            </div>

                            <hr style="border-color: #E2E8F0; margin: 2rem 0;">

                            <!-- Historial de Asignaciones -->
                            <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem;">📋 Historial de Asignaciones</h5>
                            <div class="table-responsive">
                                <table class="table" style="border: 1px solid #E2E8F0; border-radius: 0.5rem;">
                                    <thead style="background-color: var(--light);">
                                        <tr>
                                            <th style="font-weight: 600; color: #1E293B;">Usuario Asignado</th>
                                            <th style="font-weight: 600; color: #1E293B;">Asignado Por</th>
                                            <th style="font-weight: 600; color: #1E293B;">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($ticket->asignaciones as $asignacion)
                                        <tr style="border-bottom: 1px solid #E2E8F0;">
                                            <td>
                                                <span class="badge" style="background-color: var(--primary); padding: 0.375rem 0.75rem;">
                                                    {{ $asignacion->usuario->nombre ?? 'N/A' }} 
                                                    {{ $asignacion->usuario?->tipoUsuario ? '(' . $asignacion->usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                                                </span>
                                            </td>
                                            <td>{{ $asignacion->asignadoPor->name ?? 'N/A' }}</td>
                                            <td><small style="color: #64748B;">{{ $asignacion->fecha_asignacion }}</small></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted" style="padding: 2rem;">Sin historial de asignaciones</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Historial de Cambios -->
                            @if($ticket->historiales->count())
                            <hr style="border-color: #E2E8F0; margin: 2rem 0;">
                            <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem;">📝 Historial de Cambios</h5>
                            <div class="table-responsive">
                                <table class="table" style="border: 1px solid #E2E8F0; border-radius: 0.5rem;">
                                    <thead style="background-color: var(--light);">
                                        <tr>
                                            <th style="font-weight: 600; color: #1E293B;">Cambio</th>
                                            <th style="font-weight: 600; color: #1E293B;">Usuario</th>
                                            <th style="font-weight: 600; color: #1E293B;">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ticket->historiales as $historial)
                                        <tr style="border-bottom: 1px solid #E2E8F0;">
                                            <td>
                                                @if($historial->estado_anterior && $historial->estado_nuevo)
                                                    <small>Estado: <strong style="color: #EF4444;">{{ $historial->estado_anterior }}</strong> → <strong style="color: #10B981;">{{ $historial->estado_nuevo }}</strong></small>
                                                @elseif($historial->sector_anterior && $historial->sector_nuevo)
                                                    <small>Sector: <strong style="color: #8B5CF6;">{{ $historial->sector_anterior }}</strong> → <strong style="color: #2563EB;">{{ $historial->sector_nuevo }}</strong></small>
                                                @else
                                                    <small>{{ $historial->motivo ?? 'Cambio registrado' }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $historial->usuario->nombre ?? 'N/A' }}</td>
                                            <td><small style="color: #64748B;">{{ $historial->created_at->format('d/m/Y H:i') }}</small></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Comentarios -->
                            @if($ticket->comentarios->count())
                            <hr style="border-color: #E2E8F0; margin: 2rem 0;">
                            <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem;">💬 Comentarios ({{ $ticket->comentarios->count() }})</h5>
                            <div class="row">
                                @foreach($ticket->comentarios as $comentario)
                                <div class="col-lg-12">
                                    <div class="card" style="border-left: 4px solid var(--primary); margin-bottom: 1rem;">
                                        <div class="card-body" style="padding: 1rem;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <strong style="color: #1E293B;">{{ $comentario->usuario?->nombre ?? 'N/A' }}</strong>
                                                    <span style="color: #64748B; font-size: 0.875rem;">
                                                        {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}
                                                    </span>
                                                </div>
                                                <span style="color: #94A3B8; font-size: 0.875rem;">{{ $comentario->fecha }}</span>
                                            </div>
                                            <p style="margin: 0.5rem 0 0; color: var(--gray-600);">{{ $comentario->mensaje }}</p>
                                            @if($comentario->imagen)
                                            <div style="margin-top: 0.75rem;">
                                                <img src="{{ asset('storage/' . $comentario->imagen) }}" alt="Comentario imagen" style="max-width: 200px; border-radius: 0.5rem;">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="card-footer" style="background-color: var(--light); border-top: 1px solid #E2E8F0; padding: 1rem;">
                            <div class="row" style="gap: 0.5rem;">
                                <div class="col-lg-auto">
                                    <a href="{{ route('tickets.viewPdf', $ticket->id) }}" target="_blank" class="btn btn-danger" style="padding: 0.625rem 1rem;">
                                        <i class="fas fa-eye"></i> Ver PDF
                                    </a>
                                </div>
                                <div class="col-lg-auto width-min-100">
                                    <a href="{{ route('tickets.exportPdf', $ticket->id) }}" class="btn btn-danger" style="padding: 0.625rem 1rem;">
                                        <i class="fas fa-download"></i> Descargar PDF
                                    </a>
                                </div>
                                <div class="col-lg-auto">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning" style="padding: 0.625rem 1rem;">
                                        <i class="fas fa-pencil-alt"></i> Editar
                                    </a>
                                </div>
                                <div class="col-lg-auto">
                                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary" style="padding: 0.625rem 1rem;">
                                        <i class="fas fa-arrow-left"></i> Atrás
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
