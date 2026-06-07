@extends('layouts.app')

@section('title','Ver Comentario')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size:1.75rem;font-weight:500;line-height:1.2;margin-bottom:0.5rem;">
                            @yield('title') #{{ $comentario->id }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Ticket</label>
                                        <p>{{ $comentario->ticket->titulo ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Estado</label>
                                        <p>
                                            <span class="badge {{ $comentario->estado ? 'badge-success' : 'badge-danger' }}">
                                                {{ $comentario->estado ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Usuario</label>
                                        <p>{{ $comentario->usuario?->nombre ?? 'N/A' }} {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Fecha</label>
                                        <p>{{ $comentario->fecha ?? $comentario->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Mensaje</label>
                                        <p>{{ $comentario->mensaje }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-2 col-xs-4">
                                    <a href="{{ route('comentarios.viewPdf', $comentario->id) }}" target="_blank" class="btn btn-danger btn-block btn-flat"><i class="fas fa-eye"></i> Ver PDF</a>
                                </div>
                                <div class="col-lg-2 col-xs-4 width-min-100">
                                    <a href="{{ route('comentarios.exportPdf', $comentario->id) }}" class="btn btn-danger btn-block btn-flat"><i class="fas fa-download"></i> Descargar PDF</a>
                                </div>
                                <div class="col-lg-2 col-xs-4">
                                    <a href="{{ route('comentarios.index') }}" class="btn btn-secondary btn-block btn-flat">Atrás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
