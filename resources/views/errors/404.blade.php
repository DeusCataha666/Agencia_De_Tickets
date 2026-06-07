@extends('errors.layout')

@section('code', '404')

@section('content')
    <h1>404</h1>
    <h4>Página no encontrada</h4>
    <p>La página que buscas no existe o fue movida.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Volver al inicio</a>
@endsection
