@extends('layouts.app_authentication')

@section('title', 'Bienvenido')

@section('content')
    <div class="login-box" style="width: 380px;">
        <div class="card card-outline" style="border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); border: none;">
            <div class="card-header text-center" style="background: white; border: none; border-radius: 12px 12px 0 0; padding: 2.5rem 1.5rem 1.5rem;">
                <img src="{{ asset('backend/dist/img/ticket_logo.png') }}" alt="Logo" style="max-width: 100%; height: auto; max-height: 70px;">
            </div>
            <div class="card-body" style="padding: 2rem 1.5rem; text-align: center;">
                <h2 style="color: #1E293B; font-weight: 600; margin-bottom: 0.5rem;">{{ __('Bienvenido') }}</h2>
                
                @auth
                    <p style="color: #64748B; margin-bottom: 2rem;">{{ __('¿Listo para continuar?') }}</p>
                    <a href="{{ url('/home') }}" class="btn btn-primary w-100" style="background-color: #2563EB; color: white; font-weight: 600; padding: 0.75rem; border-radius: 0.5rem; border: none;">
                        {{ __('Ir al Dashboard') }}
                    </a>
                @else
                    <p style="color: #64748B; margin-bottom: 2rem;">{{ __('Inicia sesión o regístrate para continuar') }}</p>
                    <div class="row" style="gap: 1rem; display: flex;">
                        <div class="col-12" style="flex: 1;">
                            <a href="{{ route('login') }}" class="btn btn-primary w-100" style="background-color: #2563EB; color: white; font-weight: 600; padding: 0.75rem; border-radius: 0.5rem; border: none;">
                                {{ __('Iniciar Sesión') }}
                            </a>
                        </div>
                        <div class="col-12" style="flex: 1;">
                            <a href="{{ route('register') }}" class="btn w-100" style="background-color: #10B981; color: white; font-weight: 600; padding: 0.75rem; border-radius: 0.5rem; border: none;">
                                {{ __('Registrarse') }}
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection