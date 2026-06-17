@extends('layouts.app')

@section('title','Ver Comentario')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Comentario #{{ $comentario->id }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">
                Ticket: <span class="text-indigo-600 dark:text-indigo-400 font-medium">{{ $comentario->ticket->titulo ?? 'N/A' }}</span>
            </p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('comentarios.viewPdf', $comentario->id) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-rose-600 text-white hover:bg-rose-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                <i class="fas fa-eye"></i> Ver PDF
            </a>
            <a href="{{ route('comentarios.exportPdf', $comentario->id) }}"
               class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 hover:bg-rose-200 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-download"></i> Descargar PDF
            </a>
            <a href="{{ route('comentarios.index') }}"
               class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-arrow-left"></i> Atrás
            </a>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-info-circle me-2 text-indigo-500"></i> Datos del Comentario
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Ticket</p>
                <a href="{{ route('tickets.show', $comentario->ticket_id) }}"
                   class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                    #{{ $comentario->ticket_id }} — {{ $comentario->ticket->titulo ?? 'N/A' }}
                </a>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Estado</p>
                @if($comentario->estado)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Activo
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full mr-1.5"></span> Inactivo
                    </span>
                @endif
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Usuario</p>
                <p class="text-slate-800 dark:text-white font-medium">
                    {{ $comentario->usuario?->nombre ?? 'N/A' }}
                    @if($comentario->usuario && $comentario->usuario->tipoUsuario)
                        <span class="ml-1 text-xs font-normal text-slate-400">({{ $comentario->usuario->tipoUsuario->nombre_tipo }})</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Fecha</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $comentario->fecha ?? ($comentario->created_at ? $comentario->created_at->format('d/m/Y H:i') : 'N/A') }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-2">Mensaje</p>
                <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-xl p-4 text-slate-700 dark:text-slate-300 leading-relaxed border-l-4 border-l-indigo-400 dark:border-l-indigo-600">
                    {{ $comentario->mensaje }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
