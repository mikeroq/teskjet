<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        @if(View::hasSection('title'))
            @yield('title') - {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicons/site.webmanifest">
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/oneui.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/themes/amethyst.css') }}">
    <link rel="stylesheet" href="/assets/css/bootstrap-side-modals.css" />
    <link rel="stylesheet" href="/assets/css/sweetalert2.dark.min.css">
    <link rel="stylesheet" href="/assets/css/ico.css">
    @yield('css_after')
    @livewireStyles
    <script src="{{ mix('js/laravel.app.js') }}" defer></script>
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>
<body>
<div id="page-container" class="dark-mode">
    <main id="main-container">
        <div class="hero-static d-flex align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        @yield('content')
                    </div>
                </div>
                <div class="fs-sm text-muted text-center">
                    <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="{{ mix('js/oneui.app.js') }}"></script>
@stack('scripts')
@stack('modals')
@stack('modal')
@livewireScripts
@livewire('livewire-ui-modal')
@livewireUIScripts
<x-livewire-alert::scripts />
<script>
    window.addEventListener('update-title', event => {
        document.title = event.detail.title;
    });
</script>
</body>
</html>
