<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/assets/favicons/site.webmanifest') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="/assets/css/oneui.css">
    <link rel="stylesheet" id="css-theme" href="/assets/css/themes/amethyst.css">
</head>
<body>
<div id="page-container" class="dark-mode">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('/assets/media/photos/photo16@2x.jpg');">
            <div class="hero bg-primary-dark-op align-items-sm-end">
                <div class="hero-inner">
                    <div class="content content-full">
                        <div class="px-3 py-5 text-start text-sm-left">
                            <div class="display-1 text-warning fw-bold">@yield('code')</div>
                            <h1 class="h2 text-white fw-bold mt-5 mb-3">@yield('message')</h1>
                            <h2 class="h3 text-white-75 fw-normal text-muted mb-5">We are sorry but your request cannot be fulfilled..</h2>
                            <a class="btn btn-secondary" href="{{ URL::previous() }}">
                                <i class="fa fa-arrow-left mr-1"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>

