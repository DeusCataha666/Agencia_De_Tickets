@extends('layouts.app')

@section('title', 'Crear Comentario')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Nuevo Comentario</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">Agrega un nuevo comentario a un ticket existente</p>
        </div>
        <a href="{{ route('comentarios.index') }}"
           class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-comment me-2 text-indigo-500"></i> Datos del Comentario
            </h3>
        </div>

        <form method="POST" action="{{ route('comentarios.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Ticket <span class="text-rose-500">*</span>
                    </label>
                    <select name="ticket_id"
                            class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('ticket_id') border-rose-400 dark:border-rose-500 @enderror">
                        <option value="">Seleccione Ticket</option>
                        @foreach($tickets as $ticket)
                            <option value="{{ $ticket->id }}" {{ old('ticket_id') == $ticket->id ? 'selected' : '' }}>
                                #{{ $ticket->id }} - {{ $ticket->titulo }}
                            </option>
                        @endforeach
                    </select>
                    @error('ticket_id')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Usuario <span class="text-rose-500">*</span>
                    </label>
                    <select name="usuario_id"
                            class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('usuario_id') border-rose-400 dark:border-rose-500 @enderror">
                        <option value="">Seleccione Usuario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombre }} {{ $usuario->tipoUsuario ? '(' . $usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Imagen (opcional)</label>
                    <input type="file" name="imagen" accept="image/*"
                           class="block w-full text-sm text-slate-500 dark:text-slate-400
                                  file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0
                                  file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700
                                  dark:file:bg-indigo-900/30 dark:file:text-indigo-400
                                  hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50
                                  file:cursor-pointer file:transition-colors">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Mensaje <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="mensaje" rows="5" placeholder="Escribe el comentario..."
                              class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none @error('mensaje') border-rose-400 dark:border-rose-500 @enderror">{{ old('mensaje') }}</textarea>
                    @error('mensaje')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <input type="hidden" name="estado" value="1">
            <input type="hidden" name="registrado_por" value="{{ Auth::user()->id }}">

            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-2.5 rounded-xl font-semibold text-sm transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-save"></i> Registrar
                </button>
                <a href="{{ route('comentarios.index') }}"
                   class="inline-flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 px-5 py-2.5 rounded-xl font-medium text-sm transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
