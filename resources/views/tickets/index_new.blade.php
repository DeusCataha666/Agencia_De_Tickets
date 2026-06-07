@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title mb-0">
            <i class="fas fa-ticket-alt me-2"></i>Gestión de Tickets
        </h1>
        <small class="text-muted">Administra y monitorea todos tus tickets</small>
    </div>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Crear Nuevo Ticket
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Listado de Tickets
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Título</th>
                        <th width="15%">Cliente</th>
                        <th width="15%">Estado</th>
                        <th width="15%">Sector</th>
                        <th width="15%">Asignado a</th>
                        <th width="10%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td><strong>#{{ $ticket->id }}</strong></td>
                            <td>{{ Str::limit($ticket->titulo, 30) }}</td>
                            <td>{{ $ticket->cliente->nombre ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $ticket->estado == 1 ? 'success' : 'secondary' }}">
                                    {{ $ticket->estado == 1 ? 'Abierto' : 'Cerrado' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $ticket->sector ?? 'Sin sector' }}</span>
                            </td>
                            <td>{{ $ticket->usuarioAsignado->nombre ?? 'Sin asignar' }}</td>
                            <td>
                                <div class="btn-group action-buttons" role="group">
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-info" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('tickets.viewPdf', $ticket->id) }}" class="btn btn-sm btn-danger" title="PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2">No hay tickets disponibles</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    // Script para cambio de estado en línea si es necesario
</script>
@endpush
@endsection
