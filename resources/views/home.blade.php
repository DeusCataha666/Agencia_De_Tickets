@extends('layouts.app')

@section('title', 'Panel De Control')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-br from-indigo-600 to-blue-500 dark:from-indigo-900 dark:to-blue-900 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-10 -top-10 text-indigo-400/20 dark:text-indigo-800/40 transform rotate-12">
            <i class="fas fa-ticket-alt text-[12rem]"></i>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">¡Hola, {{ auth()->user()->name ?? 'Usuario' }}! 👋</h1>
            <p class="text-indigo-100 text-lg mb-6 max-w-2xl">
                Te damos la bienvenida a tu panel de control. Tienes <strong class="text-white">{{ $ticketsActivos }}</strong> tickets activos que requieren atención en este momento.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('tickets.create') }}" class="inline-flex items-center gap-2 bg-white text-indigo-600 font-semibold px-6 py-2.5 rounded-xl shadow-md hover:bg-slate-50 hover:scale-105 transition-all">
                    <i class="fas fa-plus-circle"></i> Nuevo Ticket
                </a>
                <a href="{{ route('clientes.create') ?? '#' }}" class="inline-flex items-center gap-2 bg-white/20 border border-white/40 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-white/30 transition-all">
                    <i class="fas fa-user-plus"></i> Nuevo Cliente
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 border-l-4 border-l-indigo-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Total Tickets</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalTickets }}</h3>
                </div>
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-500/10 rounded-full flex items-center justify-center text-indigo-500 text-xl">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 border-l-4 border-l-amber-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Sin Asignar</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $ticketsSinAsignar }}</h3>
                </div>
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-500/10 rounded-full flex items-center justify-center text-amber-500 text-xl">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 border-l-4 border-l-emerald-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Clientes</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalClientes }}</h3>
                </div>
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-500/10 rounded-full flex items-center justify-center text-emerald-500 text-xl">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-800 border-l-4 border-l-violet-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Comentarios</p>
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalComentarios }}</h3>
                </div>
                <div class="w-12 h-12 bg-violet-50 dark:bg-violet-500/10 rounded-full flex items-center justify-center text-violet-500 text-xl">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Column (2/3) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Charts Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-semibold text-slate-800 dark:text-slate-200"><i class="fas fa-chart-pie me-2 text-indigo-500"></i> Estado de Tickets</h3>
                    </div>
                    <div class="p-6 h-72 flex justify-center items-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="font-semibold text-slate-800 dark:text-slate-200"><i class="fas fa-chart-bar me-2 text-indigo-500"></i> Tickets por Sector</h3>
                    </div>
                    <div class="p-6 h-72 flex justify-center items-center">
                        <canvas id="sectorChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Tickets Table -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200"><i class="fas fa-ticket-alt me-2 text-indigo-500"></i> Tickets Recientes</h3>
                    <a href="{{ route('tickets.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">Ver todos</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-sm border-b border-slate-200 dark:border-slate-800">
                                <th class="py-3 px-6 font-medium">Ticket</th>
                                <th class="py-3 px-6 font-medium">Cliente</th>
                                <th class="py-3 px-6 font-medium">Asignado a</th>
                                <th class="py-3 px-6 font-medium text-center">Estado</th>
                                <th class="py-3 px-6 font-medium text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse ($recentTickets as $ticket)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="py-3 px-6">
                                    <div class="font-medium text-slate-900 dark:text-white">#{{ $ticket->id }} - {{ Str::limit($ticket->titulo, 25) }}</div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">{{ $ticket->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="py-3 px-6 text-slate-700 dark:text-slate-300">
                                    {{ $ticket->cliente->nombre ?? 'N/A' }}
                                </td>
                                <td class="py-3 px-6">
                                    @if($ticket->usuarioAsignado)
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-600 dark:text-slate-300">
                                                {{ substr($ticket->usuarioAsignado->nombre, 0, 1) }}
                                            </div>
                                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $ticket->usuarioAsignado->nombre }}</span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                            Sin Asignar
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($ticket->estado)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300">
                                            <span class="w-1.5 h-1.5 bg-slate-500 rounded-full mr-1.5"></span> Cerrado
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-right">
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors p-1" title="Ver detalle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-4xl mb-3 text-slate-300 dark:text-slate-600"></i>
                                        <p>No hay tickets recientes</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Column (1/3) -->
        <div class="space-y-6">
            
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
                <h3 class="font-semibold text-slate-800 dark:text-slate-200 mb-4"><i class="fas fa-bolt text-amber-500 me-2"></i> Acciones Rápidas</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('tickets.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-600 dark:bg-slate-800 dark:hover:bg-indigo-900/20 dark:text-slate-300 dark:hover:text-indigo-400 transition-colors text-center">
                        <i class="fas fa-ticket-alt text-xl"></i>
                        <span class="text-sm font-medium">Crear Ticket</span>
                    </a>
                    <a href="{{ route('clientes.create') ?? '#' }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-600 dark:bg-slate-800 dark:hover:bg-emerald-900/20 dark:text-slate-300 dark:hover:text-emerald-400 transition-colors text-center">
                        <i class="fas fa-user-plus text-xl"></i>
                        <span class="text-sm font-medium">Nuevo Cliente</span>
                    </a>
                    <a href="{{ route('tickets.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-600 dark:bg-slate-800 dark:hover:bg-blue-900/20 dark:text-slate-300 dark:hover:text-blue-400 transition-colors text-center">
                        <i class="fas fa-list text-xl"></i>
                        <span class="text-sm font-medium">Ver Tickets</span>
                    </a>
                    <a href="{{ route('usuarios.index') }}" class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl bg-slate-50 hover:bg-violet-50 text-slate-700 hover:text-violet-600 dark:bg-slate-800 dark:hover:bg-violet-900/20 dark:text-slate-300 dark:hover:text-violet-400 transition-colors text-center">
                        <i class="fas fa-users text-xl"></i>
                        <span class="text-sm font-medium">Usuarios</span>
                    </a>
                </div>
            </div>

            <!-- Recent Comments Timeline -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200"><i class="fas fa-comments me-2 text-indigo-500"></i> Últimos Comentarios</h3>
                </div>
                <div class="p-6">
                    @if($recentComments->count() > 0)
                        <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 dark:before:via-slate-700 before:to-transparent">
                            @foreach($recentComments as $comentario)
                            <div class="relative flex items-start gap-4">
                                <div class="absolute left-0 w-2 h-2 ml-[1.15rem] mt-2 rounded-full bg-indigo-500 ring-4 ring-white dark:ring-slate-900 z-10"></div>
                                <div class="flex-1 ml-10">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $comentario->usuario->nombre ?? 'Usuario' }}</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $comentario->fecha ? \Carbon\Carbon::parse($comentario->fecha)->diffForHumans() : $comentario->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-sm text-slate-600 dark:text-slate-300 mb-2">
                                        Comentó en el ticket <a href="{{ route('tickets.show', $comentario->ticket_id) }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">#{{ $comentario->ticket_id }}</a>
                                    </div>
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-3 rounded-lg border border-slate-100 dark:border-slate-800 text-sm text-slate-700 dark:text-slate-300">
                                        {{ Str::limit($comentario->mensaje, 80) }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-slate-500 dark:text-slate-400 py-4">
                            <i class="fas fa-comment-slash text-3xl mb-2 text-slate-300 dark:text-slate-600"></i>
                            <p>No hay comentarios recientes.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos los colores según el tema actual para los gráficos
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#f1f5f9' : '#1e293b';
        const gridColor = isDark ? '#334155' : '#e2e8f0';

        // Status Doughnut Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Cerrados'],
                datasets: [{
                    data: [{{ $ticketsActivos }}, {{ $ticketsInactivos ?? 0 }}],
                    backgroundColor: [
                        '#10b981', // Emerald 500
                        '#64748b'  // Slate 500
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            color: textColor,
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
                    backgroundColor: '#6366f1', // Indigo 500
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
                            color: textColor,
                            font: { family: "'Inter', sans-serif" }
                        },
                        grid: {
                            color: gridColor,
                            borderDash: [5, 5]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: textColor,
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

        // Observer para cambiar colores del gráfico cuando cambia el modo oscuro
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    // Si implementas la actualización dinámica de gráficos al cambiar el tema, iría aquí.
                    // Por simplicidad, se requeriría recargar o actualizar las instancias de Chart.js
                }
            });
        });
        observer.observe(document.documentElement, { attributes: true });
    });
</script>
@endpush
