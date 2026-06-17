@extends('layouts.app')

@section('title','Ver Tipo de Usuario')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tipo de Usuario #{{ $tipoUsuario->id }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">{{ $tipoUsuario->nombre_tipo }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tipousuarios.edit', $tipoUsuario) }}"
               class="inline-flex items-center gap-2 bg-amber-500 text-white hover:bg-amber-600 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                <i class="fas fa-pencil-alt"></i> Editar
            </a>
            <form action="{{ route('tipousuarios.destroy', $tipoUsuario) }}" method="POST" class="inline"
                  onsubmit="return confirm('¿Estás seguro de eliminar este tipo de usuario?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-rose-600 text-white hover:bg-rose-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm text-sm">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </form>
            <a href="{{ route('tipousuarios.index') }}"
               class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-info-circle me-2 text-indigo-500"></i> Datos del Tipo
            </h3>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Nombre del Tipo</p>
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-700 dark:text-indigo-400 font-medium text-sm">
                    <i class="fas fa-user-tag me-2 text-xs"></i>
                    {{ $tipoUsuario->nombre_tipo }}
                </span>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-1">Estado</p>
                @if($tipoUsuario->estado)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span> Activo
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full mr-1.5"></span> Inactivo
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
