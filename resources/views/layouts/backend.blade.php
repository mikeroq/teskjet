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

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>
<body>
    <div id="page-container"
        class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed page-header-dark dark-mode">
        @if (request()->is('admin*'))
            <x-admin-navigation></x-admin-navigation>
        @elseif (request()->is('user*'))
            <x-user-panel-navigation></x-user-panel-navigation>
        @else
            <x-navigation></x-navigation>
        @endif
        <header id="page-header">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
              </button>
              <!-- END Toggle Mini Sidebar -->
                </div>
                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-sm-inline-block ms-2">{{ Auth::user()->name }}</span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('profile.show') }}">
                                    <span class="fs-sm fw-medium">User Settings</span>
                                </a>
                            </div>
                            <div role="separator" class="dropdown-divider m-0"></div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="fs-sm fw-medium">Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main id="main-container">
            @yield('content')
        </main>
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-2 py-1 text-sm-end">
                    </div>
                    <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                        <a class="fw-semibold" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>  &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ mix('js/oneui.app.js') }}"></script>
    <script src="{{ mix('js/laravel.app.js') }}" defer></script>
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
