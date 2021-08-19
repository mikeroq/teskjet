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
        <div class="bg-image" style="background-image: url('/assets/media/photos/photo16@2x.jpg');">
            <div class="row g-0 bg-primary-dark-op">
                <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                    <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                        <div class="w-100">
                            <a class="link-fx fw-semibold fs-2 text-white" href="/">
                                {{ config('app.name') }}
                            </a>
                        </div>
                    </div>
                    <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                        <p class="fw-medium text-white-50 mb-0">
                            <strong>{{ config('app.name') }} 3.0</strong> &copy; <span data-toggle="year-copy"></span>
                        </p>
                        <ul class="list list-inline mb-0 py-2">
                            <li class="list-inline-item">
                                <a class="text-white-75 fw-medium" href="{{ route('terms.show') }}">Terms of Service</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-white-75 fw-medium" href="{{ route('policy.show') }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-light">
                    <div class="p-3 w-100 d-lg-none text-center">
                        <a class="link-fx fw-semibold fs-3 text-dark" href="/">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    @yield('content')
                    <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                        <p class="fw-medium text-black-50 py-2 mb-0">
                            <strong>{{ config('app.name') }} 3.0</strong> &copy; <span data-toggle="year-copy"></span>
                        </p>
                        <ul class="list list-inline py-2 mb-0">
                            <li class="list-inline-item">
                                <a class="text-muted fw-medium" href="{{ route('terms.show') }}">Terms of Service</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-muted fw-medium" href="{{ route('policy.show') }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
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
