@extends('layouts.app')

@section('title','Seleccionar Comentario para PDF')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header bg-info" style="color: white; font-size: 1.3rem; font-weight: 500; padding: 1rem;">
                            <i class="fas fa-file-pdf"></i> Seleccionar Comentario para PDF
                        </div>
                        <div class="card-body" style="padding: 2rem;">
                            <p style="color: #666; font-size: 1rem; margin-bottom: 1.5rem;">Elige una opción:</p>

                            <div style="margin-bottom: 2rem;">
                                <a href="{{ route('comentarios.exportPdfAll') }}" class="btn btn-success btn-block" style="padding: 1rem; font-size: 1.1rem; border-radius: 0.5rem;">
                                    <i class="fas fa-download"></i> Descargar PDF de Todos los Comentarios
                                </a>
                            </div>

                            <hr style="margin: 2rem 0; border-color: #ddd;">

                            <p style="color: #666; font-size: 1rem; margin-bottom: 1.5rem;">O selecciona un comentario específico:</p>

                            <div class="row">
                                @forelse($comentarios as $comentario)
                                <div class="col-md-6 mb-3">
                                    <div class="card" style="border: 2px solid #e3f2fd; border-radius: 0.5rem; background-color: #f8f9fa; transition: all 0.3s ease; height: 180px; overflow: hidden;">
                                        <div class="card-body" style="padding: 1.25rem; display: flex; justify-content: space-between; align-items: center; height: 100%;">
                                            <div style="flex-grow: 1; overflow: hidden;">
                                                <h5 style="color: #1976d2; font-weight: 600; margin-bottom: 0.5rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ $comentario->ticket->titulo ?? 'Ticket no disponible' }}
                                                </h5>
                                                <p style="color: #999; font-size: 0.9rem; margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    ID: {{ $comentario->id }}
                                                </p>
                                                <p style="color: #999; font-size: 0.85rem; margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    Usuario: {{ $comentario->usuario?->nombre ?? 'N/A' }} {{ $comentario->usuario ? '(' . $comentario->usuario->tipoUsuario?->nombre_tipo . ')' : '' }}
                                                </p>
                                                <p style="color: #999; font-size: 0.85rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ \Illuminate\Support\Str::limit($comentario->mensaje, 60) }}
                                                </p>
                                            </div>
                                            <div style="display: flex; gap: 0.5rem; margin-left: 1rem; align-items: center;">
                                                <a href="{{ route('comentarios.viewPdf', $comentario->id) }}" 
                                                   target="_blank"
                                                   class="btn btn-primary btn-sm"
                                                   title="Ver PDF"
                                                   style="padding: 0.5rem 0.75rem; background-color: #1976d2; border: none;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('comentarios.exportPdf', $comentario->id) }}"
                                                   class="btn btn-primary btn-sm width-min-100"
                                                   title="Descargar PDF"
                                                   style="padding: 0.5rem 0.75rem; background-color: #1976d2; border: none;">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i> No hay comentarios registrados.
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <div style="margin-top: 2rem;">
                                <a href="{{ route('comentarios.index') }}" class="btn btn-secondary" style="width: 100%; padding: 0.75rem;">
                                    <i class="fas fa-arrow-left"></i> Volver al Listado
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 </div>
@endsection
