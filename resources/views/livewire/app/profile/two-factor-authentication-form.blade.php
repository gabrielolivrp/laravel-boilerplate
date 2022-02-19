<div>
    <h3 class="text-lg font-medium text-gray-900">
        @if ($this->user->isEnableTwoFactor())
            {{ __('You have enabled two factor authentication.') }}
        @else
            {{ __('You have not enabled two factor authentication.') }}
        @endif
    </h3>

    <div class="mt-3 max-w-xl text-sm text-gray-600">
        <p>
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>
    </div>

    @if ($this->user->isEnableTwoFactor())
        @if ($showingQrCode)
            <div class="mt-4 max-w-xl text-sm text-gray-600">
                <p class="font-semibold">
                    {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>
            </div>

            <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white">
                {!! $this->user->twoFactorQrCodeSvg() !!}
            </div>
        @endif

        @if ($showingRecoveryCodes)
            <div class="mt-4 max-w-xl text-sm text-gray-600">
                <p class="font-semibold">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>
            </div>

            <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                    <div>{{ $code }}</div>
                @endforeach
            </div>
        @endif
    @endif

    <div class="mt-5">
        @if (! $this->user->isEnableTwoFactor())
            <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click="enableTwoFactorAuthentication">
                {{ __('Enable') }}
            </button>
        @else
            @if ($showingRecoveryCodes)
                <button class="mr-3 btn btn-secondary" wire:loading.attr="disabled" wire:click="regenerateRecoveryCodes">
                    {{ __('Regenerate recovery codes') }}
                </button>
            @else
                <button class="mr-3 btn btn-secondary" wire:loading.attr="disabled" wire:click="showRecoveryCodes">
                    {{ __('Show recovery codes') }}
                </button>
            @endif
            <button class="btn btn-danger" wire:loading.attr="disabled" wire:click="disableTwoFactorAuthentication">
                {{ __('Disable') }}
            </button>
        @endif
    </div>
</div>
