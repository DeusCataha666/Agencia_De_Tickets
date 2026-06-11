@extends('layouts.app_authentication')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md mx-auto p-6">
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden">
        
        <div class="px-8 pt-10 pb-6 text-center">
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('backend/dist/img/BCC.png') }}" alt="BCC Logo" class="h-16 w-auto max-w-[180px] object-contain">
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">{{ __('Iniciar Sesión') }}</h1>
            <p class="text-slate-500 dark:text-slate-400">{{ __('Ingresa a tu cuenta para continuar') }}</p>
        </div>

        <div class="px-8 pb-10">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('Correo Electrónico') }}</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-slate-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="tu@correo.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('Contraseña') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-slate-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:placeholder-slate-400 dark:text-white transition-colors"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-rose-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 bg-slate-50 border-slate-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-slate-800 focus:ring-2 dark:bg-slate-700 dark:border-slate-600">
                    <label for="remember" class="ml-2 text-sm font-medium text-slate-700 dark:text-slate-300">
                        {{ __('Recordarme') }}
                    </label>
                </div>

                <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-semibold rounded-xl text-sm px-5 py-3.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-sm">
                    {{ __('Ingresar al Sistema') }}
                </button>
                
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 text-center pt-4">
                    {{ __('¿No tienes cuenta?') }}
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline dark:text-indigo-400">
                        {{ __('Regístrate aquí') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
