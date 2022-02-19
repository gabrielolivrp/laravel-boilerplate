<?php

namespace App\Http\Livewire\App\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateProfileInformationForm extends Component
{
    /**
     * @var array
     */
    public array $state = [];

    /**
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->only('email', 'name');
    }

    /**
     * @param UpdatesUserProfileInformation $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        session()->flash('success', __('Profile updated successfully.'));

        $this->emit('saved');
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
     *
     * @return string
     */
    public function render()
    {
        return view('livewire.app.profile.update-profile-information-form');
    }
}
