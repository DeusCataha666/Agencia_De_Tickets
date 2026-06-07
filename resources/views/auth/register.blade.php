@extends('layouts.app_authentication')

@section('title', 'Registro')

@section('content')
    <div class="login-box" style="width: 380px;">
        <div class="card card-outline" style="border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            <div class="card-header text-center" style="background: white; border: none; border-radius: 12px 12px 0 0; padding: 2rem 1.5rem 1.5rem;">
                <img src="{{ asset('backend/dist/img/ticket_logo.png') }}" alt="Logo" style="max-height: 70px; margin-bottom: 1rem;">
            </div>
            <div class="card-body" style="padding: 2rem 1.5rem;">
                <p class="login-box-msg" style="font-size: 1.25rem; font-weight: 600; color: #1E293B; margin-bottom: 1.5rem; text-align: center;">{{ __('Crear Cuenta') }}</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight: 500; color: #1E293B;">{{ __('Nombre') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Tu nombre completo" style="border-radius: 0.5rem; border: 1px solid #E2E8F0; padding: 0.625rem 0.875rem;">
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert" style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: 500; color: #1E293B;">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="tu@correo.com" style="border-radius: 0.5rem; border: 1px solid #E2E8F0; padding: 0.625rem 0.875rem;">
                        @error('email')
                            <span class="invalid-feedback d-block" role="alert" style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-weight: 500; color: #1E293B;">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="••••••••" style="border-radius: 0.5rem; border: 1px solid #E2E8F0; padding: 0.625rem 0.875rem;">
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert" style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label" style="font-weight: 500; color: #1E293B;">{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="••••••••" style="border-radius: 0.5rem; border: 1px solid #E2E8F0; padding: 0.625rem 0.875rem;">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100" style="background-color: #2563EB; color: white; font-weight: 600; padding: 0.75rem; border-radius: 0.5rem; border: none;">
                                {{ __('Registrarse') }}
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p style="color: #64748B; font-size: 0.9rem;">
                                {{ __('¿Ya tienes cuenta?') }}
                                <a href="{{ route('login') }}" style="color: #2563EB; text-decoration: none; font-weight: 600;">
                                    {{ __('Inicia sesión aquí') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
