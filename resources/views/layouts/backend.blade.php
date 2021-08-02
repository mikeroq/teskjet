@include('modals.global.customer_create')
<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicons/site.webmanifest">
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/themes/xinspire.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-side-modals.css" />
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://bootstrap-colors-extended.herokuapp.com/bootstrap-colors.css" />
    <link rel="stylesheet" href="https://bootstrap-colors-extended.herokuapp.com/bootstrap-colors-themes.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap-pincode-input.css">
    @yield('css_after')
    @livewireStyles
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>
<body class="bg-dark">
    <div id="page-container"
        class="bg-black-10 sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed page-header-glass page-header-dark">
        @if (request()->is('admin*'))
            <x-admin-navigation></x-admin-navigation>
        @elseif (request()->is('user*'))
            <x-user-panel-navigation></x-user-panel-navigation>
        @else
            <x-navigation></x-navigation>
        @endif
        <header id="page-header">
            <div class="content-header">
                <div>
                    <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
                <div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual dropdown-toggle mr-1" id="dropdown-default-primary"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus mr-1"></i>
                            <span class="d-none d-sm-inline-block">Create</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-dark p-2" aria-labelledby="dropdown-default-primary">
                            <a class="dropdown-item" data-toggle="modal" data-target="#customer_create_modal"><i
                                    class="fas fa-users mr-1"></i> New Customer</a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual dropdown-toggle" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user mr-1"></i>
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-dark dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="p-2">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="far fa-fw fa-user mr-1"></i> User Settings
                                </a>
                                <li><hr class="dropdown-divider"></li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Sign Out
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
        <footer id="page-footer" class="bg-dark">
            <div class="content py-0">
                <div class="row font-size-sm text-body-color-light">
                    <div class="col-sm-6 order-sm-1 text-center text-primary-lighter text-sm-left">
                        <a class="font-w600" href="{{ route('dashboard') }}"
                            target="_blank">{{ config('app.name') }}</a> &copy; <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('/assets/js/dashmix.app.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/assets/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="/assets/js/bootstrap-pincode-input.js"></script>
    <script src="/assets/js/nashmix.js"></script>
    @stack('scripts')
    @stack('modals')
    @stack('modal')
    @livewireScripts
</body>
</html>
