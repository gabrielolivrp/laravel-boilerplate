<?php

namespace App\Http\Livewire\App\Profile;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class DeleteUserForm extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Delete the current user.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return mixed
     */
    public function deleteUser(StatefulGuard $auth)
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        Auth::user()->delete();

        $auth->logout();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.app.profile.delete-user-form');
    }
}
