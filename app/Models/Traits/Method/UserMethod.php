<?php

namespace App\Models\Traits\Method;

trait UserMethod
{
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @return bool
     */
    public function isEnableTwoFactor(): bool
    {
        return ! empty($this->two_factor_secret);
    }

    /**
     *
     * @return bool
     */
    public function isMasterAdmin(): bool
    {
        return $this->id === 1;
    }

    /**
     * @return bool
     */
    public function canChangeEmail(): bool
    {
        return config('boilerplate.auth.user.change_email');
    }
}
