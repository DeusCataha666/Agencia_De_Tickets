
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>419 — Sesión expirada</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/error-419.css') }}?v={{ time() }}">
</head>
<body>
    <canvas id="sand-bg"></canvas> 
    <div class="dots"></div>
    <div class="corner c1"></div>
    <div class="corner c2"></div>
    <div class="corner c3"></div> 
    <div class="corner c4"></div>

    <div class="container">
        <div class="error-code">
            ERROR <br>
            419
        </div>
        <h1 class="title">Tiempo suspendido</h1>
        <p class="description">
            <span class="text-description-warning">Tu sesión quedó atrapada en una anomalía temporal. El token de energía (CSRF) se agotó y el sistema entró en hibernación. <br> </span>
        </p>
        <span class="text-description-muted">Recarga la cápsula para continuar tu misión</span>

        <div class="token-info">
            TOKEN CSRF : <span class="bad">EXPIRADO</span><br>
            ESTADO &nbsp;&nbsp;&nbsp;&nbsp;: <span class="bad">419 TIME_LOOP</span><br>
            ACCIÓN &nbsp;&nbsp;&nbsp;&nbsp;: <span class="val">REINICIO REQUERIDO</span>
        </div>

        <div class="actions">
            <a href="{{ url()->previous() }}" class="btn-primary-ghost">Recargar Cápsula</a>
            <a href="{{ url('/') }}" class="btn-ghost">Volver A La Nave</a>
        </div>
    </div>

    <script src="{{ asset('backend/dist/js/error-419.js') }}?v={{ time() }}"></script>
</body>
</html>