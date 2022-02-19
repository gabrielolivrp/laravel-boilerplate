<?php

namespace App\Http\Livewire\App\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Livewire\Component;

class TwoFactorAuthenticationForm extends Component
{
    /**
     * Indicates if two factor authentication QR code is being displayed.
     *
     * @var bool
     */
    public bool $showingQrCode = false;

    /**
     * Indicates if two factor authentication recovery codes are being displayed.
     *
     * @var bool
     */
    public bool $showingRecoveryCodes = false;

    /**
     * Display the user's recovery codes.
     *
     * @return void
     */
    public function showRecoveryCodes()
    {
        $this->showingRecoveryCodes = true;
    }

    /**
     * Enable two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\EnableTwoFactorAuthentication $enable
     * @return void
     */
    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());

        $this->showingQrCode = true;
        $this->showingRecoveryCodes = true;
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @param GenerateNewRecoveryCodes $generate
     * @return void
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate)
    {
        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
    }

    /**
     * Disable two factor authentication for the user.
     *
     * @param DisableTwoFactorAuthentication $disable
     * @return void
     */
    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disable)
    {
        $disable(Auth::user());
    }

    /**
     * Get the current user of the application.
     *
     * @return \App\Models\User;
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Check if is required confirm password
     *
     * @return bool
     */
    private function isRequiredConfirmPassword(): bool
    {
        return Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword');
    }

    /**
     * @return string
     */
    public function render()
    {
        return view('livewire.app.profile.two-factor-authentication-form');
    }
}
