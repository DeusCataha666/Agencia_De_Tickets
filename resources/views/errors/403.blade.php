
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Acceso prohibido</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/error-403.css') }}?v={{ time() }}">
</head>
<body>
    <div class="hazard"></div>
    <div class="radial"></div>
    <div class="alert-bar"></div>
    <div class="alert-bar-b"></div>
 
    <div class="doc-card">
        <div class="stamp-wrap">
            <div class="stamp">
                <span>ACCESO</span>
                <span>DENEGADO</span>
            </div>
        </div>
 
        <div class="eye-wrap">
            <div class="eye-outer">
                <div class="eye-pupil"></div>
            </div>
        </div>
 
        <div class="badge">Acceso denegado</div>
        <div class="err-num">403</div>
        <h1>Zona restringida</h1>
        <p>
            No tienes autorización para ingresar a esta sección del espacio.  
            El escudo de seguridad galáctico bloquea tu acceso.  
            Regresa a la nave antes de activar las alarmas.
        </p>
 
        <div class="doc-lines">
            <div class="doc-line classified"></div>
            <div class="doc-line short"></div>
            <div class="doc-line classified"></div>
            <div class="doc-line"></div>
        </div>
 
        <div class="actions">
            <a href="{{ url('/') }}" class="btn-p">Salir de la zona</a>
            <a href="javascript:history.back()" class="btn-g">Volver atrás</a>
        </div>
    </div>
</body>
</html>