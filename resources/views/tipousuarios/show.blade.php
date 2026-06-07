@extends('layouts.app')

@section('title','Ver Tipo de Usuario')

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
                            @yield('title') #{{ $tipoUsuario->id }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Nombre del Tipo</label>
                                        <p>{{ $tipoUsuario->nombre_tipo }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Estado</label>
                                        <p>
                                            <span class="badge {{ $tipoUsuario->estado ? 'badge-success' : 'badge-danger' }}">
                                                {{ $tipoUsuario->estado ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tipousuarios.index') }}" class="btn btn-secondary" title="Volver"><i class="fas fa-arrow-left"></i> Volver</a>
                            <a href="{{ route('tipousuarios.edit', $tipoUsuario) }}" class="btn btn-primary" title="Editar"><i class="fas fa-pencil-alt"></i> Editar</a>
                            <form class="d-inline" action="{{ route('tipousuarios.destroy', $tipoUsuario) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro?')"><i class="fas fa-trash-alt"></i> Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
