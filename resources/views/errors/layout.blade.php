<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error @yield('code') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.css') }}">
    <style>
        body { background: #f4f6f9; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; font-family: 'Source Sans Pro', sans-serif; }
        .error-box { text-align: center; }
        .error-box h1 { font-size: 8rem; font-weight: 700; color: #dee2e6; line-height: 1; margin: 0; }
        .error-box h4 { font-size: 1.4rem; color: #555; margin: .5rem 0; }
        .error-box p { color: #888; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <div class="error-box">
        @yield('content')
    </div>
</body>
</html>
