<?php

namespace App\Http\Livewire\App\Profile;

use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordForm extends Component
{
    /**
     * @var array|string[]
     */
    public array $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => ''
    ];

    /**
     *
     * @param UpdatesUserPasswords $updater
     * @return void
     */
    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => ''
        ];

        session()->flash('success', __('Password updated successfully.'));

        $this->emit('saved');
    }

    /**
     * @return string
     */
    public function render()
    {
        return view('livewire.app.profile.update-password-form');
    }
}
