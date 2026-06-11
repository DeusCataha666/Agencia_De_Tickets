@extends('layouts.app_authentication')

@section('title', 'Bienvenido')

@section('content')
<div class="w-full max-w-md mx-auto p-6">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden text-center">
        
        <div class="px-8 pt-10 pb-6">
            <div class="flex items-center justify-center mb-8">
                <img src="{{ asset('backend/dist/img/BCC.png') }}" alt="BCC Logo" class="h-20 w-auto max-w-[220px] object-contain">
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">{{ __('Agencia de Tickets') }}</h1>
            
            @auth
                <p class="text-slate-500 dark:text-slate-400 mb-8">{{ __('¿Listo para continuar?') }}</p>
                <div class="px-4 pb-8">
                    <a href="{{ url('/home') }}" class="block w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-xl text-base px-5 py-3.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-sm">
                        <i class="fas fa-chart-pie mr-2"></i> {{ __('Ir al Panel de Control') }}
                    </a>
                </div>
            @else
                <p class="text-slate-500 dark:text-slate-400 mb-8">{{ __('Gestiona tus tickets de manera profesional y eficiente.') }}</p>
                <div class="flex flex-col sm:flex-row gap-3 px-2 pb-8">
                    <a href="{{ route('login') }}" class="flex-1 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-xl text-sm px-5 py-3.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-sm">
                        {{ __('Iniciar Sesión') }}
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-xl text-sm px-5 py-3.5 text-center dark:text-indigo-300 dark:bg-indigo-900/40 dark:hover:bg-indigo-900/60 transition-all">
                        {{ __('Crear Cuenta') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection