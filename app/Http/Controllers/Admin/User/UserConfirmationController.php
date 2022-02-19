<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Exceptions\GeneralException;
use App\Models\User;

class UserConfirmationController extends Controller
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     *
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after action.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('admin.users.index');
    }

    /**
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function resendEmailVerification(User $user)
    {
        $this->authorize('resend email verification user');

        $this->userRepository->resendEmailVerification($user);

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('Email verification was sent successfully.'));
    }

    /**
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function confirmEmailVerification(User $user)
    {
        $this->authorize('confirm email verification user');

        $this->userRepository->changeVerification($user, true);

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('The user was successfully confirmed.'));
    }

    /**
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function unconfirmEmailVerification(User $user)
    {
        $this->authorize('unconfirm email verification user');

        $this->userRepository->changeVerification($user, false);

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('The user was successfully disconfirmed.'));
    }
}
