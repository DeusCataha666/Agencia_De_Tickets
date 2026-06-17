@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Editar Cliente #{{ $cliente->id }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">{{ $cliente->nombre }}</p>
        </div>
        <a href="{{ route('clientes.index') }}"
           class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 px-4 py-2 rounded-xl font-medium transition-colors text-sm">
            <i class="fas fa-arrow-left"></i> Atrás
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                <i class="fas fa-handshake me-2 text-indigo-500"></i> Información del Cliente
            </h3>
        </div>

        <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
            @csrf
            @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Nombre <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}"
                           placeholder="Nombre del cliente"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('nombre') border-rose-400 dark:border-rose-500 @enderror">
                    @error('nombre')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Dirección
                    </label>
                    <input type="text" name="direccion" value="{{ old('direccion', $cliente->direccion) }}"
                           placeholder="Dirección"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('direccion') border-rose-400 dark:border-rose-500 @enderror">
                    @error('direccion')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                        Teléfono
                    </label>
                    <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}"
                           placeholder="Teléfono"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('telefono') border-rose-400 dark:border-rose-500 @enderror">
                    @error('telefono')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 text-white hover:bg-indigo-700 px-6 py-2.5 rounded-xl font-semibold text-sm transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('clientes.index') }}"
                   class="inline-flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 px-5 py-2.5 rounded-xl font-medium text-sm transition-colors">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
