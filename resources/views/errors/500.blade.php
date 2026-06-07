@extends('errors.layout')

@section('code', '500')

@section('content')
    <h1>500</h1>
    <h4>Error interno del servidor</h4>
    <p>Ocurrió un error inesperado. Intenta más tarde o comunícate con el administrador.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Volver al inicio</a>
@endsection
