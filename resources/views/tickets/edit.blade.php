@extends('layouts.app')

@section('title', 'Editar Ticket')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary" style="color: white; font-weight: 600;">
                            <h3 style="margin: 0;">@yield('title') #{{ $ticket->id }}</h3>
                        </div>
                        <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <!-- Sección: Información Básica -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem; border-bottom: 2px solid var(--primary); padding-bottom: 0.5rem;">ℹ️ Información Básica</h5>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Título <strong style="color:red;">*</strong></label>
                                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" placeholder="Título del ticket" autocomplete="off" value="{{ old('titulo', $ticket->titulo) }}" style="border-radius: 0.5rem;">
                                            @error('titulo')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Cliente <strong style="color:red;">*</strong></label>
                                            <select class="form-control @error('cliente_id') is-invalid @enderror" name="cliente_id" style="border-radius: 0.5rem;">
                                                <option value="">Seleccione Cliente</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $ticket->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                        {{ $cliente->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cliente_id')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Descripción</label>
                                            <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="4" placeholder="Descripción detallada del ticket" style="border-radius: 0.5rem;">{{ old('descripcion', $ticket->descripcion) }}</textarea>
                                            @error('descripcion')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr style="border-color: #E2E8F0; margin: 2rem 0;">

                                <!-- Sección: Asignación y Estado -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem; border-bottom: 2px solid var(--success); padding-bottom: 0.5rem;">👤 Asignación y Estado</h5>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Usuario Asignado</label>
                                            <select class="form-control @error('usuario_asignado_id') is-invalid @enderror" name="usuario_asignado_id" style="border-radius: 0.5rem;">
                                                <option value="">🔄 Sin asignar</option>
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}" {{ old('usuario_asignado_id', $ticket->usuario_asignado_id) == $usuario->id ? 'selected' : '' }}>
                                                        👤 {{ $usuario->nombre }} {{ $usuario->tipoUsuario ? '(' . $usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('usuario_asignado_id')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                            @if($ticket->usuarioAsignado)
                                                <small style="color: #64748B; margin-top: 0.5rem; display: block;">
                                                    ✓ Asignado a: <strong>{{ $ticket->usuarioAsignado->nombre }}</strong>
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Sector</label>
                                            <input type="text" class="form-control @error('sector') is-invalid @enderror" name="sector" placeholder="Sector o área" value="{{ old('sector', $ticket->sector) }}" style="border-radius: 0.5rem;">
                                            @error('sector')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Estado</label>
                                            <select class="form-control @error('estado') is-invalid @enderror" name="estado" style="border-radius: 0.5rem;">
                                                <option value="1" {{ old('estado', $ticket->estado) == 1 ? 'selected' : '' }}>Abierto</option>
                                                <option value="0" {{ old('estado', $ticket->estado) == 0 ? 'selected' : '' }}>Cerrado</option>
                                            </select>
                                            @error('estado')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Motivo del Cambio (opcional)</label>
                                            <textarea class="form-control" name="motivo_cambio" rows="2" placeholder="Explica por qué se realizó este cambio" style="border-radius: 0.5rem;">{{ old('motivo_cambio', '') }}</textarea>
                                            <small class="text-muted">Este motivo se registrará en el historial de cambios</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Fecha de Creación</label>
                                            <input type="date" class="form-control @error('fecha_creacion') is-invalid @enderror" name="fecha_creacion" value="{{ old('fecha_creacion', is_object($ticket->fecha_creacion) ? $ticket->fecha_creacion->format('Y-m-d') : $ticket->fecha_creacion) }}" style="border-radius: 0.5rem;">
                                            @error('fecha_creacion')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Fecha de Cierre</label>
                                            <input type="date" class="form-control @error('fecha_cierre') is-invalid @enderror" name="fecha_cierre" value="{{ old('fecha_cierre', $ticket->fecha_cierre) }}" style="border-radius: 0.5rem;">
                                            @error('fecha_cierre')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr style="border-color: #E2E8F0; margin: 2rem 0;">

                                <!-- Sección: Archivos -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem; border-bottom: 2px solid var(--warning); padding-bottom: 0.5rem;">📎 Archivos</h5>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" style="font-weight: 600; color: #1E293B;">Imagen</label>
                                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" accept="image/*" style="border-radius: 0.5rem;">
                                            @error('imagen')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                            @if($ticket->imagen)
                                                <div style="margin-top: 1rem;">
                                                    <strong style="color: #1E293B;">Imagen actual:</strong>
                                                    <br>
                                                    <img src="{{ asset('storage/' . $ticket->imagen) }}" alt="Imagen del ticket" style="max-width: 100%; max-height: 180px; border: 1px solid #E2E8F0; padding: 4px; margin-top: 0.5rem; border-radius: 0.5rem;" />
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Historial de Asignaciones Reciente -->
                                @if($ticket->asignaciones->count())
                                <hr style="border-color: #E2E8F0; margin: 2rem 0;">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 style="font-weight: 600; color: #1E293B; margin-bottom: 1rem;">📋 Últimas Asignaciones</h5>
                                    </div>
                                    <div class="col-12">
                                        <div style="background-color: var(--light); padding: 1rem; border-radius: 0.5rem; border-left: 4px solid var(--primary);">
                                            @foreach($ticket->asignaciones->take(3) as $asignacion)
                                                <div style="padding: 0.5rem 0; border-bottom: 1px solid #E2E8F0;" class="{{ $loop->last ? 'border-0' : '' }}">
                                                    <small>
                                                        <strong>{{ $asignacion->usuario->nombre ?? 'N/A' }}</strong> 
                                                        {{ $asignacion->usuario?->tipoUsuario ? '(' . $asignacion->usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                                                        <span style="color: #94A3B8;"> - Asignado por: {{ $asignacion->asignadoPor->name ?? 'N/A' }}</span>
                                                        <span style="color: #94A3B8; float: right;">{{ $asignacion->fecha_asignacion }}</span>
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="card-footer" style="background-color: var(--light); border-top: 1px solid #E2E8F0; padding: 1.5rem;">
                                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                                    <button type="submit" class="btn btn-primary" style="padding: 0.625rem 1.5rem;">
                                        <i class="fas fa-save"></i> Actualizar
                                    </button>
                                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary" style="padding: 0.625rem 1.5rem;">
                                        <i class="fas fa-arrow-left"></i> Atrás
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection