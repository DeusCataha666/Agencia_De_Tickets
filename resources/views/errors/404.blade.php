@extends('layouts.app_authentication')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Página no encontrada</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/error-404.css') }}">
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</head>
<body>
    <canvas id="space"></canvas>
    <div class="nebula"></div>
    <div class="searchlight"></div>

    <!-- Astronauta flotante (fuera del contenedor, se mueve libre) -->
    <model-viewer
        id="astronaut"
        class="astronaut-model"
        src="{{ asset('backend/dist/models/astronaut.glb') }}"
        alt="Astronauta 3D"
        auto-rotate
        auto-rotate-delay="0"
        rotation-per-second="45deg"
        interaction-prompt="none"
        disable-zoom
        shadow-intensity="0"
        exposure="1.2"
        style="--poster-color: transparent;">
    </model-viewer>
    <model-viewer
    id="ovni"
    class="ovni-model"
    src="{{ asset('backend/dist/models/UFO2.glb') }}"
    alt="OVNI 3D"
    auto-rotate
    auto-rotate-delay="0"
    rotation-per-second="45deg"
    interaction-prompt="none"
    disable-zoom
    shadow-intensity="0"
    exposure="1.2"
    style="--poster-color: transparent;">
    </model-viewer>

    <div class="container">
        <div class="error-code">404</div>
        <h1 class="title">¿A dónde vas, astronauta?</h1>
        <p class="description">
            Esta ruta se perdió en el espacio profundo.<br>
            No hay señal, no hay mapa, no hay destino.<br>
            Regresa a la nave antes de quedarte sin oxígeno.
        </p>
        <div class="signal">— SEÑAL PERDIDA &middot; COORDENADAS INVÁLIDAS —</div>
        <div class="actions">
            <a href="{{ url('/') }}" class="btn-primary">Volver a la nave</a>
        </div>
    </div>

    <script src="{{ asset('backend/dist/js/error-404.js') }}"></script>
</body>
</html>
