@extends('layouts.simple')

@section('content')
    <div class="bg-image" style="background-image: url('assets/media/photos/photo16@2x.jpg');">
        <div class="row no-gutters justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                        <div class="mb-2 text-center">
                            <a class="link-fx text-warning font-w700 font-size-h1" href="/">
                                <span class="text-dark">{{ config('app.name') }}</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Confirm Password</p>
                            <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
                        </div>
                        <x-jet-validation-errors class="mb-4" />
                        <form action="{{ route('password.confirm') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                    autocomplete="current-password" autofocus />
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-hero-primary">
                                    {{ __('Confirm') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

