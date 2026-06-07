@extends('layouts.app')

@section('title','Listado De Tipos de Usuario')

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
				<div class="col-12">
					<div class="card">
						<div class="card-header bg-primary" style="font-size: 1.75rem; font-weight: 600; line-height: 1.2; margin-bottom: 0; color: white; display: flex; justify-content: space-between; align-items: center;">
							@yield('title')
                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <a href="{{ route('tipousuarios.create') }}" class="btn btn-light" title="Nuevo Tipo" style="padding: 0.5rem 1rem; font-size: 0.9rem; color: #1E293B;">
                                    <i class="fas fa-plus"></i> Nuevo
                                </a>
                            </div>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover" style="width:100%">
								<thead style="background-color: var(--light);">
									<tr>
                                        <th width="10px" style="font-weight: 600; color: #1E293B;">ID</th>
                                        <th style="font-weight: 600; color: #1E293B;">Nombre del Tipo</th>
                                        <th width="60px" style="font-weight: 600; color: #1E293B;">Estado</th>
                                        <th width="130px" style="font-weight: 600; color: #1E293B;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($tipoUsuarios as $tipoUsuario)
									<tr>
										<td>{{ $tipoUsuario->id }}</td>
										<td>{{ $tipoUsuario->nombre_tipo }}</td>
										<td>
											<label class="toggle-switch-custom">
												<input data-type="tipousuario" data-id="{{$tipoUsuario->id}}" class="toggle-class" type="checkbox" {{ $tipoUsuario->estado ? 'checked' : '' }}>
												<span class="toggle-slider"></span>
											</label>
										</td>
										<td>
                                            <div style="display: flex; gap: 0.375rem;">
                                                <a href="{{ route('tipousuarios.show', $tipoUsuario) }}" class="btn btn-info btn-sm" title="Ver" style="padding: 0.375rem 0.625rem; min-width: 38px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tipousuarios.edit', $tipoUsuario) }}" class="btn btn-warning btn-sm" title="Editar" style="padding: 0.375rem 0.625rem; min-width: 38px;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form class="d-inline delete-form" action="{{ route('tipousuarios.destroy', $tipoUsuario) }}" method="POST" style="display: inline;">
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
