@extends('layouts.backend')
@section('content')
    <x-page-header title="{{ $user->full_name }}" subtitle="Linked Accounts"></x-page-header>
    <div class="content">
        <h2 class="content-heading">Linked Accounts</h2>
        <div class="row push">
            <div class="col-lg-4">
                <p class="text-muted">
                    Link social logins and modify them here.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="block block-rounded">
                    <div class="block-content">
                        @if(!empty($status))
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h3 class="alert-heading font-size-h4 my-2">Error</h3>
                                <p class="mb-0">
                                    @if($status == 'fail-inuse')
                                        The external account you're trying to connect is connected to a different {{ config('app.name') }} account.
                                    @endif
                                </p>
                            </div>
                            @endif

                            @foreach($connections as $connection)

                                <div class="row">
                                <div class="col-12">
                                <a class="block block-rounded block-transparent block-link-shadow bg-{{ $connection->provider->color}}" href="javascript:void(0)">
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="font-size-lg font-w600 mb-0 text-white">
                                                {{ $connection->provider->name }} Account: {{ $connection->email}}
                                            </p>
                                            <p class="text-white-75 mb-0">
                                                Remove connection with {{ $connection->provider->name }}
                                            </p>
                                        </div>
                                        <div class="ml-3 item">
                                            <i class="fa-2x {{ $connection->provider->icon }} text-white-50"></i>
                                        </div>
                                    </div>
                                </a>
                            </div></div>
                            @endforeach
                            @foreach($providers as $provider)
                                @foreach($connections as $connection)
                                    @if($connection->auth_provider_id == $provider->id)

                                    @else
                                    <div class="row">
                                    <div class="col-12">
                                        <a class="block block-rounded block-transparent block-link-shadow bg-info" href="javascript:void(0)">
                                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="font-size-lg font-w600 mb-0 text-white">
                                                        {{ $provider->name }}
                                                    </p>
                                                    <p class="text-white-75 mb-0">
                                                        Link Account
                                                    </p>
                                                </div>
                                                <div class="ml-3 item">
                                                    <i class="fa-2x {{ $provider->icon }} text-white-50"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                    @endif
                                @endforeach
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">

    </script>
@endpush
