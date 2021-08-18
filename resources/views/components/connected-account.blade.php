@props(['provider', 'createdAt' => null])

<div>
    @if (! empty($createdAt))
        <div class="form-group row">
            <div class="col-sm-10 col-md-8 col-xl-6">
                <button class="btn btn-block btn-alt-primary bg-transparent d-flex align-items-center justify-content-between" disabled>
                    <span>
                        @switch($provider)
                            @case(JoelButcher\Socialstream\Providers::facebook())
                                <i class="fab fa-fw fa-facebook opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::google())
                                <i class="fab fa-fw fa-google opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::twitter())
                                <i class="fab fa-fw fa-twitter opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::linkedin())
                                <i class="fab fa-fw fa-linkedin opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::github())
                                <i class="fab fa-fw fa-github opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::gitlab())
                                <i class="fab fa-fw fa-gitlab opacity-50 me-1"></i>
                                @break
                            @case(JoelButcher\Socialstream\Providers::bitbucket())
                                <i class="fab fa-fw fa-bitbucket opacity-50 me-1"></i>
                                @break
                            @default
                        @endswitch
                        {{ __(ucfirst($provider)) }}
                    </span>
                    <i class="fa fa-fw fa-check me-1"></i>
                </button>
            </div>
            <div class="col-sm-12 col-md-4 col-xl-6 mt-1 d-md-flex align-items-md-center font-size-sm">
                {{ $action }}
            </div>
        </div>
    @else
        <div class="form-group row">
            <div class="col-sm-10 col-md-8 col-xl-6">
                <button class="btn btn-block btn-alt-info text-left" disabled>
                    @switch($provider)
                        @case(JoelButcher\Socialstream\Providers::facebook())
                            <i class="fab fa-fw fa-facebook opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::google())
                            <i class="fab fa-fw fa-google opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::twitter())
                            <i class="fab fa-fw fa-twitter opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::linkedin())
                            <i class="fab fa-fw fa-linkedin opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::github())
                            <i class="fab fa-fw fa-github opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::gitlab())
                            <i class="fab fa-fw fa-gitlab opacity-50 me-1"></i>
                            @break
                        @case(JoelButcher\Socialstream\Providers::bitbucket())
                            <i class="fab fa-fw fa-bitbucket opacity-50 me-1"></i>
                            @break
                        @default
                    @endswitch
                    Connect to {{ $provider }}
                </button>
            </div>
        </div>
    @endif


    @error($provider.'_connect_error')
        <div class="text-sm font-semibold text-red-500 px-3 mt-2">
            {{ $message }}
        </div>
    @enderror
</div>
