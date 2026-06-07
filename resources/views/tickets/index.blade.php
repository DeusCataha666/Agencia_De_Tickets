@extends('layouts.app')

@section('title','Listado De Tickets')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary" style="font-size: 1.75rem; font-weight: 600; line-height: 1.2; margin-bottom: 0; color: white; display: flex; justify-content: space-between; align-items: center;">
                            @yield('title')
                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <a href="{{ route('reportes.excel.general') }}" class="btn btn-success" title="Exportar Excel General" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('tickets.create') }}" class="btn btn-light" title="Nuevo Ticket" style="padding: 0.5rem 1rem; font-size: 0.9rem; color: #1E293B;">
                                    <i class="fas fa-plus"></i> Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead style="background-color: var(--light);">
                                    <tr>
                                        <th width="10px" style="font-weight: 600; color: #1E293B;">ID</th>
                                        <th style="font-weight: 600; color: #1E293B;">Título</th>
                                        <th style="font-weight: 600; color: #1E293B;">Descripción</th>
                                        <th width="70px" style="font-weight: 600; color: #1E293B;">Imagen</th>
                                        <th style="font-weight: 600; color: #1E293B;">Cliente</th>
                                        <th style="font-weight: 600; color: #1E293B;">Asignado a</th>
                                        <th width="60px" style="font-weight: 600; color: #1E293B;">Estado</th>
                                        <th width="130px" style="font-weight: 600; color: #1E293B;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr style="border-bottom: 1px solid #E2E8F0;">
                                        <td style="color: var(--dark); font-weight: 500;">{{ $ticket->id }}</td>
                                        <td style="color: var(--dark);">
                                            <strong>{{ $ticket->titulo }}</strong>
                                        </td>
                                        <td style="color: #64748B;">{{ \Illuminate\Support\Str::limit($ticket->descripcion, 50) }}</td>
                                        <td>
                                            @if($ticket->imagen)
                                                <img src="{{ asset('storage/' . $ticket->imagen) }}" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:4px;">
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td style="color: var(--dark);">{{ $ticket->cliente->nombre ?? 'N/A' }}</td>
                                        <td>
                                            @if($ticket->usuarioAsignado)
                                                <span class="badge" style="background-color: var(--primary); padding: 0.375rem 0.75rem; color: white;">
                                                    {{ $ticket->usuarioAsignado->nombre }}
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #94A3B8; padding: 0.375rem 0.75rem; color: white;">
                                                    Sin asignar
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <label class="toggle-switch-custom">
                                                <input data-type="ticket" data-id="{{$ticket->id}}" class="toggle-class" type="checkbox" {{ $ticket->estado ? 'checked' : '' }}>
                                                <span class="toggle-slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 0.375rem;">
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm" title="Ver" style="padding: 0.375rem 0.625rem; min-width: 38px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning btn-sm" title="Editar" style="padding: 0.375rem 0.625rem; min-width: 38px;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form class="d-inline delete-form" action="{{ route('tickets.destroy', $ticket) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" style="padding: 0.375rem 0.625rem; min-width: 38px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 </div>

@push('js')
<script src="{{ asset('backend/dist/js/statuschange.js') }}?v=3"></script>
@endpush

@endsection
