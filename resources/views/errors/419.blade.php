@extends('errors.layout')

@section('code', '419')

@section('content')
    <h1>419</h1>
    <h4>Sesión expirada</h4>
    <p>Tu sesión ha expirado. Recarga la página e intenta de nuevo.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
@endsection
