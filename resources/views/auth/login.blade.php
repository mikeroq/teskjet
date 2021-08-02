@extends('layouts.simple')

@section('content')
    <div class="bg-image" style="background-image: url('assets/media/photos/photo16@2x.jpg');">
        <div class="row no-gutters bg-primary-op">
            <div class="hero-static col-md-6 d-flex align-items-center bg-dark text-gray">
                <div class="p-3 w-100">
                    <div class="mb-3 text-center">
                        <a class="link-fx font-w700 font-size-h1" href="/">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    <div class="row no-gutters justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <x-jet-validation-errors class="mb-4" />
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="js-validation-signin" method="POST" action="{{ route('login') }}">
                                @csrf

                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                            <input id="email" type="email"
                                                class="form-control form-control-lg form-control-alt" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Password</label>
                                            <input id="password" type="password"
                                                class="form-control form-control-lg form-control-alt" name="password"
                                                required autocomplete="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" name="remember"
                                                id="remember_me" checked>
                                            <label class="custom-control-label"
                                                for="remember_me">{{ __('Remember me') }}</label>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                    </button>
                                    <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-sm btn-dark d-block d-lg-inline-block mb-1"
                                                href="{{ route('password.request') }}">
                                                <i class="fa fa-exclamation-triangle text-muted mr-1"></i>
                                                Forgot Password
                                            </a>
                                        @endif
                                        @if (Route::has('register'))
                                            <a class="btn btn-sm btn-dark d-block d-lg-inline-block mb-1"
                                                href="{{ route('register') }}">
                                                <i class="fa fa-plus text-muted mr-1"></i> Register
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </form>
                            @if (JoelButcher\Socialstream\Socialstream::show())
                                <x-socialstream-providers />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">

            </div>
        </div>
    </div>
@endsection
