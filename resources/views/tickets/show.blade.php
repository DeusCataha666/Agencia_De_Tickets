@extends('layouts.app')

@section('title','Ver Ticket')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                Ticket #{{ $ticket->id }}
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">{{ $ticket->titulo }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tickets.viewPdf', $ticket->id) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-rose-600 text-white hover:bg-rose-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                <i class="fas fa-eye"></i> Ver PDF
            </a>
            <a href="{{ route('tickets.exportPdf', $ticket->id) }}"
               class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 hover:bg-rose-200 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-download"></i> Descargar PDF
            </a>
            <a href="{{ route('tickets.edit', $ticket->id) }}"
               class="inline-flex items-center gap-2 bg-amber-500 text-white hover:bg-amber-600 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                <i class="fas fa-pencil-alt"></i> Editar
            </a>
            <a href="{{ route('tickets.index') }}"
               class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-arrow-left"></i> Atrás
            </a>
        </div>
    </div>

    {{-- Main Info Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-info-circle me-2 text-indigo-500"></i> Información Principal
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Cliente</p>
                <p class="text-slate-900 dark:text-white font-medium">{{ $ticket->cliente->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Estado</p>
                @if($ticket->estado)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Activo
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full mr-1.5"></span> Cerrado
                    </span>
                @endif
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Usuario Asignado</p>
                @if($ticket->usuarioAsignado)
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 font-medium text-sm">
                        <i class="fas fa-user text-xs"></i>
                        {{ $ticket->usuarioAsignado->nombre }}
                        {{ $ticket->usuarioAsignado->tipoUsuario ? '(' . $ticket->usuarioAsignado->tipoUsuario->nombre_tipo . ')' : '' }}
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">Sin asignar</span>
                @endif
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Sector</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $ticket->sector ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Fecha de Creación</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $ticket->fecha_creacion ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Fecha de Cierre</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $ticket->fecha_cierre ?? 'Aún abierto' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-2">Descripción</p>
                <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-xl p-4 text-slate-700 dark:text-slate-300 leading-relaxed">
                    {{ $ticket->descripcion ?? 'Sin descripción' }}
                </div>
            </div>
            @if($ticket->imagen)
            <div class="md:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-2">Imagen Adjunta</p>
                <img src="{{ asset('storage/' . $ticket->imagen) }}" alt="Imagen del ticket"
                     class="max-h-72 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
            </div>
            @endif
        </div>
    </div>

    {{-- Historial de Asignaciones --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-clipboard-list me-2 text-indigo-500"></i> Historial de Asignaciones
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-sm border-b border-slate-200 dark:border-slate-800">
                        <th class="py-3 px-6 font-medium">Usuario Asignado</th>
                        <th class="py-3 px-6 font-medium">Asignado Por</th>
                        <th class="py-3 px-6 font-medium">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($ticket->asignaciones as $asignacion)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                        <td class="py-3 px-6">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 font-medium text-sm">
                                {{ $asignacion->usuario->nombre ?? 'N/A' }}
                                {{ $asignacion->usuario?->tipoUsuario ? '(' . $asignacion->usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-slate-700 dark:text-slate-300">{{ $asignacion->asignadoPor->name ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-slate-500 dark:text-slate-400 text-sm">{{ $asignacion->fecha_asignacion }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-slate-500 dark:text-slate-400">
                            <i class="fas fa-inbox text-3xl mb-2 text-slate-300 dark:text-slate-600 block mb-2"></i>
                            Sin historial de asignaciones
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Historial de Cambios --}}
    @if($ticket->historiales->count())
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-history me-2 text-violet-500"></i> Historial de Cambios
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-sm border-b border-slate-200 dark:border-slate-800">
                        <th class="py-3 px-6 font-medium">Cambio</th>
                        <th class="py-3 px-6 font-medium">Usuario</th>
                        <th class="py-3 px-6 font-medium">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($ticket->historiales as $historial)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                        <td class="py-3 px-6 text-sm">
                            @if($historial->estado_anterior && $historial->estado_nuevo)
                                Estado:
                                <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $historial->estado_anterior }}</span>
                                <i class="fas fa-arrow-right text-slate-400 mx-1 text-xs"></i>
                                <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $historial->estado_nuevo }}</span>
                            @elseif($historial->sector_anterior && $historial->sector_nuevo)
                                Sector:
                                <span class="font-semibold text-violet-600 dark:text-violet-400">{{ $historial->sector_anterior }}</span>
                                <i class="fas fa-arrow-right text-slate-400 mx-1 text-xs"></i>
                                <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $historial->sector_nuevo }}</span>
                            @else
                                <span class="text-slate-600 dark:text-slate-300">{{ $historial->motivo ?? 'Cambio registrado' }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-slate-700 dark:text-slate-300">{{ $historial->usuario->nombre ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-slate-500 dark:text-slate-400 text-sm">{{ $historial->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- Comentarios --}}
    @if($ticket->comentarios->count())
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-comments me-2 text-indigo-500"></i> Comentarios
                <span class="ml-2 text-xs font-semibold bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-400 px-2 py-0.5 rounded-full">{{ $ticket->comentarios->count() }}</span>
            </h3>
        </div>
        <div class="p-6 space-y-4">
            @foreach($ticket->comentarios as $comentario)
            <div class="border-l-4 border-indigo-400 dark:border-indigo-600 bg-slate-50 dark:bg-slate-800/40 rounded-r-xl p-4">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <span class="font-semibold text-slate-900 dark:text-white text-sm">{{ $comentario->usuario?->nombre ?? 'N/A' }}</span>
                        @if($comentario->usuario && $comentario->usuario->tipoUsuario)
                            <span class="ml-2 text-xs text-slate-400 dark:text-slate-500">({{ $comentario->usuario->tipoUsuario->nombre_tipo }})</span>
                        @endif
                    </div>
                    <span class="text-xs text-slate-400 dark:text-slate-500">{{ $comentario->fecha }}</span>
                </div>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">{{ $comentario->mensaje }}</p>
                @if($comentario->imagen)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $comentario->imagen) }}" alt="Imagen comentario"
                         class="max-w-48 rounded-lg border border-slate-200 dark:border-slate-700">
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
