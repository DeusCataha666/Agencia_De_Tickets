<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Error del servidor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/error-500.css') }}?v={{ time() }}">
</head>
<body>
    <canvas id="matrix"></canvas>
    <div class="vignette"></div>

    <div class="container">
        <div class="srv-rack">
            <div class="srv-unit"><div class="srv-led led-ok"></div><div class="srv-bar live"></div></div>
            <div class="srv-unit"><div class="srv-led led-err"></div><div class="srv-bar"></div><div class="srv-smoke"></div></div>
            <div class="srv-unit"><div class="srv-led led-err"></div><div class="srv-bar"></div></div>
            <div class="srv-unit"><div class="srv-led led-ok"></div><div class="srv-bar live"></div></div>
        </div>

        <div class="badge">Fallo interno</div>
        <div class="err-num">500</div>
        <h1>El servidor explotó</h1>

        <div class="terminal">
            <span class="err">× CRITICAL</span> kernel panic — not syncing<br>
            <span class="dim">  at App\Http\Kernel::handle()</span><br>
            <span class="dim">  status: </span><span class="err">500 INTERNAL_SERVER_ERROR</span><span class="cursor"></span>
        </div>

        <p>Nuestro equipo ya fue notificado.<br>Intenta de nuevo en unos momentos.</p>

        <div class="actions">
            <a href="{{ url('/') }}" class="btn-p">Ir al inicio</a>
            <a href="javascript:location.reload()" class="btn-g">Reintentar</a>
        </div>
    </div>

    <script src="{{ asset('backend/dist/js/error-500.js') }}?v={{ time() }}"></script>

</body>

</html>