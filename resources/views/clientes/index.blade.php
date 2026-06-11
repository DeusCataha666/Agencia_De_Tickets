@extends('layouts.app')

@section('title', 'Listado De Clientes')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Clientes</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('reportes.excel.clientes') }}" class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-500/30 px-4 py-2 rounded-xl font-medium transition-colors">
                <i class="fas fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('clientes.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
        <div class="p-6">
            <table id="example1" class="w-full text-left border-collapse datatable" style="width:100%">
                <thead>
                    <tr class="text-slate-500 dark:text-slate-400 text-sm border-b border-slate-200 dark:border-slate-800">
                        <th class="py-3 px-4 font-medium">ID</th>
                        <th class="py-3 px-4 font-medium">Nombre</th>
                        <th class="py-3 px-4 font-medium">Dirección</th>
                        <th class="py-3 px-4 font-medium">Teléfono</th>
                        <th class="py-3 px-4 font-medium text-center">Estado</th>
                        <th class="py-3 px-4 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @foreach($clientes as $cliente)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors group">
                        <td class="py-3 px-4 text-slate-500 dark:text-slate-400 font-medium">#{{ $cliente->id }}</td>
                        <td class="py-3 px-4 font-medium text-slate-900 dark:text-white">
                            {{ $cliente->nombre }}
                        </td>
                        <td class="py-3 px-4 text-slate-500 dark:text-slate-400">
                            {{ $cliente->direccion }}
                        </td>
                        <td class="py-3 px-4 text-slate-500 dark:text-slate-400">
                            {{ $cliente->telefono }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" data-type="cliente" data-id="{{$cliente->id}}" class="sr-only peer toggle-class" {{ $cliente->estado ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-emerald-500"></div>
                            </label>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('clientes.show', $cliente) }}" class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors" title="Ver">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('clientes.edit', $cliente) }}" class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 flex items-center justify-center hover:bg-amber-100 dark:hover:bg-amber-900/40 transition-colors" title="Editar">
                                    <i class="fas fa-pencil-alt text-sm"></i>
                                </a>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 flex items-center justify-center hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors" title="Eliminar">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('backend/dist/js/statuschange.js') }}?v=4"></script>
@endpush
@endsection