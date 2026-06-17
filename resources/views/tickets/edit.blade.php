@extends('layouts.app')

@section('title', 'Editar Ticket')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Editar Ticket #{{ $ticket->id }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">{{ $ticket->titulo }}</p>
        </div>
        <a href="{{ route('tickets.index') }}"
           class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>
    </div>

    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- Información Básica --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                        <i class="fas fa-info-circle me-2 text-indigo-500"></i> Información Básica
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Título <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="titulo" value="{{ old('titulo', $ticket->titulo) }}"
                               placeholder="Título del ticket"
                               class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('titulo') border-rose-400 dark:border-rose-500 @enderror">
                        @error('titulo')
                            <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Cliente <span class="text-rose-500">*</span>
                        </label>
                        <select name="cliente_id"
                                class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('cliente_id') border-rose-400 dark:border-rose-500 @enderror">
                            <option value="">Seleccione Cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ old('cliente_id', $ticket->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Descripción</label>
                        <textarea name="descripcion" rows="4" placeholder="Descripción detallada del ticket"
                                  class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none @error('descripcion') border-rose-400 dark:border-rose-500 @enderror">{{ old('descripcion', $ticket->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Asignación y Estado --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                        <i class="fas fa-user-check me-2 text-emerald-500"></i> Asignación y Estado
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Usuario Asignado</label>
                        <select name="usuario_asignado_id"
                                class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="">Sin asignar</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('usuario_asignado_id', $ticket->usuario_asignado_id) == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }} {{ $usuario->tipoUsuario ? '(' . $usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @if($ticket->usuarioAsignado)
                            <p class="mt-1.5 text-xs text-slate-400 dark:text-slate-500">
                                Actualmente asignado a: <strong class="text-slate-600 dark:text-slate-300">{{ $ticket->usuarioAsignado->nombre }}</strong>
                            </p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Sector</label>
                        <input type="text" name="sector" value="{{ old('sector', $ticket->sector) }}"
                               placeholder="Sector o área"
                               class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('sector') border-rose-400 dark:border-rose-500 @enderror">
                        @error('sector')
                            <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Estado</label>
                        <select name="estado"
                                class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="1" {{ old('estado', $ticket->estado) == 1 ? 'selected' : '' }}>Abierto</option>
                            <option value="0" {{ old('estado', $ticket->estado) == 0 ? 'selected' : '' }}>Cerrado</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Fecha de Creación</label>
                        <input type="date" name="fecha_creacion"
                               value="{{ old('fecha_creacion', is_object($ticket->fecha_creacion) ? $ticket->fecha_creacion->format('Y-m-d') : $ticket->fecha_creacion) }}"
                               class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Fecha de Cierre</label>
                        <input type="date" name="fecha_cierre"
                               value="{{ old('fecha_cierre', $ticket->fecha_cierre) }}"
                               class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Motivo del Cambio</label>
                        <textarea name="motivo_cambio" rows="2" placeholder="Explica por qué se realizó este cambio (opcional)"
                                  class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">{{ old('motivo_cambio') }}</textarea>
                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Este motivo quedará registrado en el historial de cambios.</p>
                    </div>

                </div>
            </div>

            {{-- Archivos --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                        <i class="fas fa-paperclip me-2 text-amber-500"></i> Archivos
                    </h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Imagen</label>
                    <input type="file" name="imagen" accept="image/*"
                           class="block w-full text-sm text-slate-500 dark:text-slate-400
                                  file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0
                                  file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700
                                  dark:file:bg-indigo-900/30 dark:file:text-indigo-400
                                  hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50
                                  file:cursor-pointer file:transition-colors">
                    @if($ticket->imagen)
                    <div class="mt-4">
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-2">Imagen actual:</p>
                        <img src="{{ asset('storage/' . $ticket->imagen) }}" alt="Imagen actual"
                             class="max-h-44 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm">
                    </div>
                    @endif
                </div>
            </div>

            {{-- Últimas Asignaciones --}}
            @if($ticket->asignaciones->count())
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                        <i class="fas fa-clipboard-list me-2 text-indigo-500"></i> Últimas Asignaciones
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    @foreach($ticket->asignaciones->take(3) as $asignacion)
                    <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-slate-100 dark:border-slate-800' : '' }}">
                        <div>
                            <span class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $asignacion->usuario->nombre ?? 'N/A' }}</span>
                            @if($asignacion->usuario?->tipoUsuario)
                                <span class="ml-1 text-xs text-slate-400">({{ $asignacion->usuario->tipoUsuario->nombre_tipo }})</span>
                            @endif
                            <span class="ml-2 text-xs text-slate-400 dark:text-slate-500">— por {{ $asignacion->asignadoPor->name ?? 'N/A' }}</span>
                        </div>
                        <span class="text-xs text-slate-400 dark:text-slate-500">{{ $asignacion->fecha_asignacion }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-3 mt-6 pt-0">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-2.5 rounded-xl font-semibold text-sm transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('tickets.index') }}"
               class="inline-flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 px-5 py-2.5 rounded-xl font-medium text-sm transition-colors">
                Cancelar
            </a>
        </div>

    </form>

</div>
@endsection
