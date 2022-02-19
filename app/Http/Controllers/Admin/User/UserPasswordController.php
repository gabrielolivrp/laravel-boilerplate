<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\EditPasswordRequest;
use App\Http\Requests\Admin\User\UpdatePasswordRequest;
use App\Repositories\UserRepository;
use App\Models\User;

class UserPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    /**
     * @param EditPasswordRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(EditPasswordRequest $request, User $user)
    {
        $this->authorize(['change password user']);

        return view('admin.users.change-password')
            ->withUser($user);
    }

    /**
     * @param UpdatePasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdatePasswordRequest $request, User $user)
    {
        $this->authorize(['change password user']);

        $this->userRepository->updatePassword($user, $request->validated());

        return redirect()->route('admin.users.index')
            ->withFlashSuccess('The user\'s password was successfully updated.');
    }
}
