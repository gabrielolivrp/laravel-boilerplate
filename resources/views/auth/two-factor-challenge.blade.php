@extends('layouts.auth')

@section('title', __('Two factor authenticate'))

@section('content')
<div class="card">
    <div class="card-header">{{ __('Two factor authenticate') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="my-4 text-sm text-gray-600">
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </div>

        <div class="my-4 text-sm text-gray-600">
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        </div>

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="form-group row"  id="input-use-code">
                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>
                <div class="col-md-6">
                    <input id="code" type="text" class="form-control" name="code" autocomplete="one-time-code" autofocus />
                </div>
            </div>

            <div class="form-group row d-none" id="input-recovery-code">
                <label for="recovery_code" class="col-md-4 col-form-label text-md-right">{{ __('Recovery code') }}</label>
                <div class="col-md-6">
                    <input id="recovery_code" type="text" class="form-control" name="recovery_code" autocomplete="one-time-code" />
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="button" class="btn btn-link" id="btn-recovery-code">
                        {{ __('Use a recovery code') }}
                    </button>

                    <button type="button" class="btn btn-link d-none" id="btn-use-code">
                        {{ __('Use an authentication code') }}
                    </button>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const btnUseCode = document.getElementById('btn-use-code');
        const btnRecoveryCode = document.getElementById('btn-recovery-code');
        const inputUseCode = document.getElementById('input-use-code');
        const inputRecoveryCode = document.getElementById('input-recovery-code');

        document.getElementById('btn-use-code').addEventListener('click', function() {
            btnUseCode.classList.add('d-none');
            btnRecoveryCode.classList.remove('d-none');
            inputUseCode.classList.remove('d-none');
            inputRecoveryCode.classList.add('d-none');
        });

        document.getElementById('btn-recovery-code').addEventListener('click', function() {
            btnUseCode.classList.remove('d-none');
            btnRecoveryCode.classList.add('d-none');
            inputUseCode.classList.add('d-none');
            inputRecoveryCode.classList.remove('d-none');
        });
    </script>
@endpush
