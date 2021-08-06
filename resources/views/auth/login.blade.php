@extends('layouts.auth')

@section('content')
    <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
        <div class="w-100">
            <div class="text-center mb-5">
                <p class="mb-3">
                    <i class="ico-send fa-3x text-primary-light"></i>
                </p>
                <p class="fw-medium text-muted">
                    Welcome, please log in or <a href="{{ route('register') }}">register</a> for a new account.
                </p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-4">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email">Email Address</label>
                            <input id="email" type="email"
                                class="form-control form-control-alt" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="email">Password</label>
                            <input id="password" type="password"
                                class="form-control form-control-alt" name="password"
                                required autocomplete="password">
                        </div>
                        <div class="mb-4">
                            <div class="custom-control custom-checkbox custom-control-primary">
                                <input type="checkbox" class="custom-control-input" name="remember"
                                    id="remember_me" checked>
                                <label class="custom-control-label"
                                    for="remember_me">{{ __('Remember me') }}</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            @if (Route::has('password.request'))
                                <div>
                                    <a class="text-muted fs-sm fw-medium d-block d-lg-inline-block mb-1" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                </div>
                            @endif
                            <div>
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Log In
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="d-grid gap-2">
                        @if (JoelButcher\Socialstream\Socialstream::show())
                            <x-socialstream-providers />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
