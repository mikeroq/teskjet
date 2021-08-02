@extends('layouts.auth')

@section('content')
    <p class="text-uppercase font-w700 font-size-sm text-muted text-center">Two Factor Challenge</p>
    <div x-data="{ recovery: false }">
        <p x-show="! recovery">
            {{ __('Please confirm access to your account by entering the code provided by your authenticator application.') }}
        </p>
        <p x-show="recovery">
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        </p>
        <x-jet-validation-errors class="mb-4" />
        <form class="form-horizontal" action="{{ route('two-factor.login') }}" method="POST"
            id="2fa_form">
            @csrf
            <div class="form-group" x-show="! recovery">
                <input type="text" id="code" name="code" x-ref="code" autocomplete="one-time-code">
            </div>
            <div class="form-group" x-show="recovery">
                <x-jet-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                <x-jet-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code"
                    x-ref="recovery_code" autocomplete="one-time-code" />
            </div>
            <div class="form-group text-center">
                <x-jet-button id="auth_btn" disabled>
                    <i class="fas fa-fw fa-key mr-1"></i> Verify
                </x-jet-button>
            </div>
            <div class="form-group text-center">
                <button type="button" class="btn btn-alt-info btn-sm" x-show="! recovery" x-on:click="
                            recovery = true;
                            $nextTick(() => { $refs.recovery_code.focus() })
                        ">
                    {{ __('Use Recovery Code') }}
                </button>
                <button type="button" class="btn btn-alt-info btn-sm" x-show="recovery" x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                    {{ __('Use Authenticator') }}
                </button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#code').pincodeInput({
                hidedigits: false,
                inputs: 6,
                inputclass: 'form-control-lg form-control-alt',
                complete: function(value, e, errorElement) {
                    $('#auth_btn').prop('disabled', false);
                    $('#2fa_form').submit();
                },
                keydown: function(e) {
                    $('#auth_btn').prop('disabled', true);
                }
            }).data('plugin_pincodeInput').focus();
        });
    </script>
@endpush
