@extends('layouts.app_authentication')

@section('title', 'Registro')

@section('content')
<div class="w-full max-w-md mx-auto p-6">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden">
        
        <div class="px-8 pt-10 pb-6 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 mb-6">
                <i class="fas fa-user-plus text-4xl text-indigo-600 dark:text-indigo-400"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">{{ __('Crear Cuenta') }}</h1>
            <p class="text-slate-500 dark:text-slate-400">{{ __('Regístrate para comenzar') }}</p>
        </div>

        <div class="px-8 pb-10">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Nombre') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-slate-400"></i>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="Tu nombre completo">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Correo Electrónico') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-slate-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="tu@correo.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Contraseña') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Confirmar Contraseña') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-slate-400"></i>
                        </div>
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-xl text-sm px-5 py-3.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-sm">
                        {{ __('Registrarse') }}
                    </button>
                </div>
                
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 text-center pt-2">
                    {{ __('¿Ya tienes cuenta?') }}
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                        {{ __('Inicia sesión aquí') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
