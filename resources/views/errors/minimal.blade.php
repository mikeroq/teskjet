<!doctype html>
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('assets/css/themes/xinspire.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/custom.css') }}">
    @yield('css_after')
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('/assets/media/photos/photo16@2x.jpg');">
            <div class="hero bg-primary-op align-items-sm-end">
                <div class="hero-inner">
                    <div class="content content-full">
                        <div class="px-3 py-5 text-center text-sm-left">
                            <div class="display-1 text-warning font-w700">@yield('code')</div>
                            <h1 class="h2 text-white font-w700 mt-5 mb-3">@yield('message')</h1>
                            <h2 class="h3 text-white-75 font-w400 text-muted mb-5">We are sorry but your request cannot be fulfilled..</h2>
                            <a class="btn btn-hero-light" href="{{ URL::previous() }}">
                                <i class="fa fa-arrow-left mr-1"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="/assets/js/dashmix.app.min.js"></script>
</body>
</html>

