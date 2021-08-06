@extends('layouts.auth')

@section('content')
<div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
    <div class="w-100">
        <div class="text-center mb-5">
            <p class="mb-3">
                <i class="ico-send fa-3x text-primary-light"></i>
            </p>
            <p class="fw-medium text-muted">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-sm-8 col-xl-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <x-jet-validation-errors class="mb-4" />
                <form action="{{ route('password.confirm') }}" method="POST">
                    @csrf
                    <x-form-group id="password" label="Password">
                        <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                    </x-form-group>
                    <x-form-group class="text-center">
                        <x-jet-button>
                            {{ __('Confirm') }}
                        </x-jet-button>
                    </x-form-group>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection