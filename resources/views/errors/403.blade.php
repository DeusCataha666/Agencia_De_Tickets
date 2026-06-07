@extends('errors.layout')

@section('code', '403')

@section('content')
    <h1>403</h1>
    <h4>Acceso no autorizado</h4>
    <p>No tienes permisos para acceder a esta página.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Volver al inicio</a>
@endsection
