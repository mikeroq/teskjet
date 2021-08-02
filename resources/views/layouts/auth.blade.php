<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicons/site.webmanifest">
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/xinspire.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="/assets/css/bootstrap-pincode-input.css">
    @yield('css_after')
    @livewireStyles
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>
<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('/assets/media/photos/photo16@2x.jpg');">
            <div class="row no-gutters bg-primary-op">
                <div class="hero-static col-md-6 d-flex align-items-center bg-dark text-gray">
                    <div class="p-3 w-100">
                        <div class="mb-3 text-center">
                            <a class="link-fx font-w700 font-size-h1" href="/">
                                {{ config('app.name') }}
                            </a>
                        </div>
                        <div class="row no-gutters justify-content-center">
                            <div class="col-sm-8 col-xl-6">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                </div>
            </div>
        </div>
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
@stack('modals')
@livewireScripts
</body>
</html>
