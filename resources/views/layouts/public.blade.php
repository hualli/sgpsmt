<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inicio')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Estilos de AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    {{-- Navbar superior (opcional) --}}
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <span class="brand-text font-weight-light">Sistema de Permisos SMT</span>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <div class="content-wrapper">
        <div class="content">
            <div class="container py-5">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Footer (opcional) --}}
    <footer class="main-footer text-center">
        <small>© {{ date('Y') }} - SMT</small>
    </footer>
</div>

{{-- Scripts de AdminLTE --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>