@extends('layouts.app')

@section('title', 'Panel De Control')

@push('css')
<style>
    .dashboard-banner {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 1rem;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        position: relative;
        overflow: hidden;
    }
    .dashboard-banner::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        transform: translate(30%, 30%);
    }
    .stat-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .stat-icon {
        position: absolute;
        right: -10px;
        bottom: -10px;
        font-size: 5rem;
        opacity: 0.05;
        transform: rotate(-15deg);
        transition: all 0.3s ease;
    }
    .stat-card:hover .stat-icon {
        transform: rotate(0) scale(1.1);
        opacity: 0.1;
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    .stat-label {
        color: #64748b;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .card-custom {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    .card-custom .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.5rem;
        font-weight: 700;
        font-size: 1.2rem;
        color: #1e293b;
    }
    .card-custom .card-body {
        padding: 1.5rem;
    }
    .action-btn {
        border-radius: 0.75rem;
        padding: 1rem;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }
    .action-btn i {
        font-size: 1.5rem;
    }
    .action-btn:hover {
        transform: scale(1.02);
        opacity: 0.9;
        text-decoration: none;
        color: white;
    }
    .table-custom th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        background: #f8fafc;
        border-top: none;
    }
    .table-custom td {
        vertical-align: middle;
        color: #334155;
        font-weight: 500;
    }
    .timeline-item {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1.5rem;
        border-left: 2px solid #e2e8f0;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -0.4rem;
        top: 0;
        width: 0.75rem;
        height: 0.75rem;
        border-radius: 50%;
        background: #3b82f6;
        border: 2px solid white;
        box-shadow: 0 0 0 2px #3b82f6;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    
    <!-- Welcome Banner -->
    <div class="dashboard-banner">
        <div style="position: relative; z-index: 1;">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 0.5rem;">¡Hola, {{ auth()->user()->nombre ?? 'Usuario' }}! 👋</h1>
            <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 1.5rem; max-width: 600px;">Te damos la bienvenida a tu panel de control. Tienes <strong>{{ $ticketsActivos }}</strong> tickets activos que requieren atención en este momento.</p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('tickets.create') }}" class="btn" style="background: white; color: #1e3a8a; font-weight: 600; border-radius: 2rem; padding: 0.6rem 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Ticket
                </a>
                <a href="{{ route('clientes.create') ?? '#' }}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.4); font-weight: 600; border-radius: 2rem; padding: 0.6rem 1.5rem;">
                    <i class="fas fa-user-plus me-2"></i> Nuevo Cliente
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card" style="border-left: 5px solid #3b82f6;">
                <div class="stat-label">Total Tickets</div>
                <div class="stat-value" style="color: #1e293b;">{{ $totalTickets }}</div>
                <i class="fas fa-ticket-alt stat-icon text-primary"></i>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card" style="border-left: 5px solid #f59e0b;">
                <div class="stat-label">Sin Asignar</div>
                <div class="stat-value" style="color: #f59e0b;">{{ $ticketsSinAsignar }}</div>
                <i class="fas fa-exclamation-triangle stat-icon text-warning"></i>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card" style="border-left: 5px solid #10b981;">
                <div class="stat-label">Clientes</div>
                <div class="stat-value" style="color: #10b981;">{{ $totalClientes }}</div>
                <i class="fas fa-users stat-icon text-success"></i>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="stat-card" style="border-left: 5px solid #8b5cf6;">
                <div class="stat-label">Comentarios</div>
                <div class="stat-value" style="color: #8b5cf6;">{{ $totalComentarios }}</div>
                <i class="fas fa-comments stat-icon" style="color: #8b5cf6;"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <!-- Charts Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-chart-pie me-2 text-primary"></i> Estado de Tickets</span>
                        </div>
                        <div class="card-body" style="height: 300px; display: flex; justify-content: center; align-items: center;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-custom">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-chart-bar me-2 text-primary"></i> Tickets por Sector</span>
                        </div>
                        <div class="card-body" style="height: 300px; display: flex; justify-content: center; align-items: center;">
                            <canvas id="sectorChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tickets Table -->
            <div class="card-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2 text-primary"></i> Tickets Recientes</span>
                    <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 20px;">Ver todos</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Ticket</th>
                                    <th>Cliente</th>
                                    <th>Asignado A</th>
                                    <th>Estado</th>
                                    <th class="text-end pe-4">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTickets as $ticket)
                                <tr>
                                    <td class="ps-4">
                                        <div style="font-weight: 700; color: #1e293b;">#{{ $ticket->id }} - {{ Str::limit($ticket->titulo, 30) }}</div>
                                        <div style="font-size: 0.8rem; color: #64748b;">{{ $ticket->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>{{ $ticket->cliente->nombre ?? 'N/A' }}</td>
                                    <td>
                                        @if($ticket->usuarioAsignado)
                                            <span class="badge" style="background-color: #e0e7ff; color: #4338ca;">
                                                <i class="fas fa-user me-1"></i> {{ $ticket->usuarioAsignado->nombre }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary text-white">Sin asignar</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ticket->estado)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Cerrado</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-light" style="border-radius: 50%; width: 35px; height: 35px; padding: 0; line-height: 35px; text-align: center;">
                                            <i class="fas fa-chevron-right text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No hay tickets recientes</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            
            <!-- Quick Actions -->
            <div class="card-custom">
                <div class="card-header">
                    <i class="fas fa-bolt me-2 text-warning"></i> Acciones Rápidas
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('tickets.create') }}" class="action-btn text-white w-100" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                <i class="fas fa-ticket-alt"></i>
                                <span style="font-size: 0.9rem;">Crear Ticket</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('clientes.create') ?? '#' }}" class="action-btn text-white w-100" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="fas fa-user-plus"></i>
                                <span style="font-size: 0.9rem;">Nuevo Cliente</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('tickets.index') }}" class="action-btn text-white w-100" style="background: linear-gradient(135deg, #64748b, #475569);">
                                <i class="fas fa-list"></i>
                                <span style="font-size: 0.9rem;">Ver Tickets</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('usuarios.index') }}" class="action-btn text-white w-100" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                                <i class="fas fa-users-cog"></i>
                                <span style="font-size: 0.9rem;">Usuarios</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Comments Timeline -->
            <div class="card-custom">
                <div class="card-header">
                    <i class="fas fa-comments me-2 text-primary"></i> Últimos Comentarios
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @forelse($recentComments as $comentario)
                        <div class="timeline-item">
                            <div style="font-size: 0.85rem; color: #64748b; font-weight: 600; margin-bottom: 0.2rem;">
                                {{ $comentario->usuario->nombre ?? 'Usuario' }} 
                                <span class="ms-1 fw-normal" style="color: #94a3b8;"><i class="far fa-clock"></i> {{ $comentario->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="color: #1e293b; font-weight: 500; font-size: 0.95rem; line-height: 1.4;">
                                "{{ Str::limit($comentario->mensaje, 60) }}"
                            </div>
                            <div style="margin-top: 0.3rem;">
                                <a href="{{ route('tickets.show', $comentario->ticket_id) }}" style="font-size: 0.8rem; text-decoration: none; font-weight: 600;" class="text-primary">
                                    Ver en Ticket #{{ $comentario->ticket_id }} <i class="fas fa-arrow-right ms-1" style="font-size: 0.7rem;"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted">No hay comentarios recientes</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Status Doughnut Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const ticketsActivos = {{ $ticketsActivos }};
        const ticketsInactivos = {{ $ticketsInactivos }};
        
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Cerrados'],
                datasets: [{
                    data: [ticketsActivos, ticketsInactivos],
                    backgroundColor: [
                        '#3b82f6', // blue
                        '#ef4444'  // red
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'Inter', sans-serif",
                                size: 13
                            }
                        }
                    }
                }
            }
        });

        // Sector Bar Chart
        const sectorCtx = document.getElementById('sectorChart').getContext('2d');
        const sectoresData = @json($ticketsPorSector);
        
        const labels = sectoresData.map(item => item.sector);
        const data = sectoresData.map(item => item.count);

        // Fallback for empty data
        if (labels.length === 0) {
            labels.push('Sin Sectores');
            data.push(0);
        }

        new Chart(sectorCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tickets',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { family: "'Inter', sans-serif" }
                        },
                        grid: {
                            borderDash: [5, 5]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { family: "'Inter', sans-serif" }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
