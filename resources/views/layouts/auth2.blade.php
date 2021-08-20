<!doctype html>
<html lang="{{ config('app.locale') }}">
<x-layout.head/>
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
