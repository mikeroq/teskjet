<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>{{ config('app.name') }}</title>
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/xinspire.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/custom.css') }}">
        <link rel="stylesheet" href="/css/bootstrap-pincode-input.css">
        @yield('css_after')
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <div id="page-container">
            <main id="main-container">
                @yield('content')
            </main>
        </div>
        <script src="{{ asset('assets/js/dashmix.app.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="assets/js/plugins/jquery-validation/additional-methods.js"></script>
        <script src="assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-pincode-input.js"></script>
        <script src="assets/js/nashmix.js"></script>
        @stack('scripts')


    </body>
</html>
