@extends('layouts.auth2')

@section('content')
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">Two Factor Challenge</h3>
            <div class="block-options">
                <a class="btn-block-option" href="/" data-bs-toggle="tooltip" data-bs-placement="left" title="Go Home">
                    <i class="fa fa-home"></i>
                </a>
            </div>
        </div>
        <div class="block-content" x-data="{ recovery: false }">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                <h1 class="h2 mb-1">{{ config('app.name')}}</h1>
                <p x-show="! recovery">
                    {{ __('Please confirm access to your account by entering the code provided by your authenticator application.') }}
                </p>
                <p x-show="recovery">
                    {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                </p>
                <x-jet-validation-errors class="mb-4"/>
                <form class="form-horizontal" action="{{ route('two-factor.login') }}" method="POST" id="2fa_form">
                    @csrf
                    <x-form-group x-show="! recovery" id="code" label="Authentication Code">
                        <x-jet-input hidden id="code" name="code" value=""/>
                        <div id="OTPInput" class="input-group"></div>
                    </x-form-group>
                    <x-form-group x-show="recovery" id="recovery_code" label="Recovery Code">
                        <x-jet-input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code"
                                     autocomplete="one-time-code"/>
                    </x-form-group>
                    {{-- <x-form-group class="text-center">
                        <x-jet-button id="auth_btn" disabled>
                            <i class="fas fa-fw fa-key me-1"></i> Verify
                        </x-jet-button>
                    </x-form-group> --}}
                    <x-form-group class="text-center">
                        <button type="button" class="btn btn-alt-info btn-sm" x-show="! recovery" x-on:click="
                        recovery = true;
                        $nextTick(() => { $refs.recovery_code.focus() })
                    ">
                            Use Recovery Code Instead
                        </button>
                        <button type="button" class="btn btn-alt-info btn-sm" x-show="recovery" x-on:click="
                        recovery = false;
                        $nextTick(() => { $refs.code.focus() })
                    ">
                            Use Authenticator Code Instead
                        </button>
                    </x-form-group>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const $otp_length = 6;

            const element = document.getElementById('OTPInput');
            for (let i = 0; i < $otp_length; i++) {
                let inputField = document.createElement('input'); // Creates a new input element
                inputField.className = "form-control form-control-alt text-center";
                // Do individual OTP input styling here;
//   inputField.style.cssText = "color: transparent; text-shadow: 0 0 0 gray;"
                inputField.id = 'otp-field' + i; // Don't remove
                inputField.maxLength = 1; // Sets individual field length to 1 char
                element.appendChild(inputField); // Adds the input field to the parent div (OTPInput)
            }
            document.getElementById('otp-field0').focus();

            /*  This is for switching back and forth the input box for user experience */
            const inputs = document.querySelectorAll('#OTPInput > *[id]');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function (event) {
                    if (event.key === "Backspace") {

                        if (inputs[i].value === '') {
                            if (i !== 0) {
                                inputs[i - 1].focus();
                            }
                        } else {
                            inputs[i].value = '';
                        }

                    } else if (event.key === "ArrowLeft" && i !== 0) {
                        inputs[i - 1].focus();
                    } else if (event.key === "ArrowRight" && i !== inputs.length - 1) {
                        inputs[i + 1].focus();
                    } else if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") {
                        inputs[i].setAttribute("type", "text");
                        inputs[i].value = ''; // Bug Fix: allow user to change a random otp digit after pressing it
                        setTimeout(function () {
                            inputs[i].setAttribute("type", "password");
                        }, 750); // Hides the text after 1 sec
                    }
                });
                inputs[i].addEventListener('input', function () {
                    inputs[i].value = inputs[i].value.toUpperCase(); // Converts to Upper case. Remove .toUpperCase() if conversion isnt required.
                    if (i === inputs.length - 1 && inputs[i].value !== '') {
                        return true;
                    } else if (inputs[i].value !== '') {
                        inputs[i + 1].focus();
                    }
                });

            }
            /*  This is to get the value on pressing the submit button
              *   In this example, I used a hidden input box to store the otp after compiling data from each input fields
              *   This hidden input will have a name attribute and all other single character fields won't have a name attribute
              *   This is to ensure that only this hidden input field will be submitted when you submit the form */
            document.getElementById('otp-field5').addEventListener("input", function () {
                const inputs = document.querySelectorAll('#OTPInput > *[id]');
                let compiledOtp = '';
                for (let i = 0; i < inputs.length; i++) {
                    compiledOtp += inputs[i].value;
                }
                document.getElementById('code').value = compiledOtp;
                document.getElementById('2fa_form').submit();
            })

            document.getElementById('auth_btn').addEventListener("click", function () {
                const inputs = document.querySelectorAll('#OTPInput > *[id]');
                let compiledOtp = '';
                for (let i = 0; i < inputs.length; i++) {
                    compiledOtp += inputs[i].value;
                }
                document.getElementById('code').value = compiledOtp;

                return true;
            });
        }, false);

    </script>
@endpush