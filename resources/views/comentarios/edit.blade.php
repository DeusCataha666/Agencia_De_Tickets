@extends('layouts.app')

@section('title', 'Editar Comentario')

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
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        <form method="POST" action="{{ route('comentarios.update', $comentario->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Ticket <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="ticket_id">
                                                <option value="">Seleccione Ticket</option>
                                                @foreach($tickets as $ticket)
                                                    <option value="{{ $ticket->id }}" {{ old('ticket_id', $comentario->ticket_id) == $ticket->id ? 'selected' : '' }}>
                                                        {{ $ticket->titulo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Usuario <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="usuario_id">
                                                <option value="">Seleccione Usuario</option>
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}" {{ old('usuario_id', $comentario->usuario_id) == $usuario->id ? 'selected' : '' }}>
                                                        {{ $usuario->nombre }} {{ $usuario->tipoUsuario ? '(' . $usuario->tipoUsuario->nombre_tipo . ')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha</label>
                                            <input type="date" class="form-control" name="fecha" value="{{ old('fecha', is_object($comentario->fecha) ? $comentario->fecha->format('Y-m-d') : $comentario->fecha) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mensaje <strong style="color:red;">(*)</strong></label>
                                            <textarea class="form-control" name="mensaje" rows="4" placeholder="Escribe el comentario">{{ old('mensaje', $comentario->mensaje) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('comentarios.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                                    </div>
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
