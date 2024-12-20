<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Primary Meta Tags -->
    <title>Manajemen Risiko</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset("img/favicon/apple-touch-icon.png")}}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset("img/favicon/favicon-32x32.png")}}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset("img/favicon/favicon-16x16.png")}}>
    <link rel="manifest" href={{ asset("img/favicon/site.webmanifest")}}>
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    {{-- tailwindcss --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    @yield('styles')

</head>

<body>
    <main>
        <!-- Section -->
        <section class="vh-lg-100 mt-lg-0 bg-soft d-flex align-items-center">
            @yield('content')
        </section>
    </main>

    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('js/volt.js') }}"></script>

    @yield('scripts')
</body>

</html>