@extends('layouts.app')

@section('title','Ver Cliente')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Cliente #{{ $cliente->id }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">{{ $cliente->nombre }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('clientes.viewPdf', $cliente->id) }}" target="_blank"
               class="inline-flex items-center gap-2 bg-rose-600 text-white hover:bg-rose-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                <i class="fas fa-eye"></i> Ver PDF
            </a>
            <a href="{{ route('clientes.exportPdf', $cliente->id) }}"
               class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 hover:bg-rose-200 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-download"></i> Descargar PDF
            </a>
            <a href="{{ route('clientes.index') }}"
               class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-arrow-left"></i> Atrás
            </a>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-info-circle me-2 text-indigo-500"></i> Datos del Cliente
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Nombre</p>
                <p class="text-slate-900 dark:text-white font-medium">{{ $cliente->nombre }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Estado</p>
                @if($cliente->estado)
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
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Dirección</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $cliente->direccion ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Teléfono</p>
                <p class="text-slate-700 dark:text-slate-300">{{ $cliente->telefono ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    {{-- Tickets Asociados --}}
    @if($cliente->tickets->count())
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex items-center justify-between">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-ticket-alt me-2 text-indigo-500"></i> Tickets Asociados
            </h3>
            <span class="text-xs font-semibold bg-indigo-100 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-400 px-2 py-0.5 rounded-full">{{ $cliente->tickets->count() }}</span>
        </div>
        <div class="p-6 space-y-3">
            @foreach($cliente->tickets as $ticket)
            <div class="flex items-start justify-between p-4 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 hover:border-indigo-200 dark:hover:border-indigo-800 transition-colors">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-xs font-medium text-slate-400">#{{ $ticket->id }}</span>
                        <span class="font-semibold text-slate-900 dark:text-white text-sm">{{ $ticket->titulo }}</span>
                    </div>
                    @if($ticket->descripcion)
                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2">{{ \Illuminate\Support\Str::limit($ticket->descripcion, 100) }}</p>
                    @endif
                </div>
                <div class="ml-4 flex-shrink-0 text-right">
                    <span class="text-xs text-slate-400 dark:text-slate-500">{{ $ticket->fecha_creacion }}</span>
                    <div class="mt-1">
                        @if($ticket->estado)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">Activo</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">Cerrado</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
