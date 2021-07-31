<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ mix('css/dashmix.css') }}">
</head>
<body>
    <div id="page-container">
        <main id="main-container">
            <div class="bg-video" data-vide-bg="/media/videos/cat" data-vide-options="posterType: jpg">
                <div class="hero bg-black-90">
                    <div class="hero-inner">
                        <div class="content content-full">
                            <div class="px-3 py-5 text-center">
                                <div class="mb-3">
                                    <a class="link-fx font-w700 font-size-h1" href="/">
                                        <span class="text-white">{{ config('app.name') }}</span>
                                    </a>
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Maintenance Mode</p>
                                </div>
                                <h1 class="text-white font-w700 mt-5 mb-3">Working on some stuff..</h1>
                                <h2 class="h3 text-white-75 font-w400 text-muted mb-5">Don’t worry though, we’ll be back
                                    soon!</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/js/plugins/vide/jquery.vide.min.js"></script>
</body>
</html>
