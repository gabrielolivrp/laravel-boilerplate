<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Exceptions\GeneralException;
use App\Models\User;

class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var string
     */
    protected string $resource = 'admin.users.';

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
     * Display a listing of the resource deactivated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable|string
     */
    public function deactivated(Request $request)
    {
        $this->authorize(['reactivate user', 'deactivate user']);

        return view($this->resource.'deactivated');
    }

    /**
     * Deactivate user
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function deactivate(User $user)
    {
        $this->authorize('deactivate user');

        $this->userRepository->mark($user, false);

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('User deactivating successfully.'));
    }

    /**
     * Change status active of the user
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function reactivate(User $user)
    {
        $this->authorize('reactivate user');

        $this->userRepository->mark($user, true);

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('User activating successfully.'));
    }
}

