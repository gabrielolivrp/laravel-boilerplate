<?php


namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Exceptions\GeneralException;
use App\Models\User;

class UserDeletedController extends Controller
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
     * Display a listing of the resource deleted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable|string
     */
    public function deleted(Request $request)
    {
        $this->authorize(['permanently delete user', 'restore user']);

        return view($this->resource.'deleted');
    }

    /**
     * Permanently delete a user
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function forceDelete($id)
    {
        $this->authorize('permanently delete user');

        $this->userRepository->permanentlyDelete(User::withTrashed()->findOrFail($id));

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('The user was permanently deleted.'));
    }

    /**
     * Restore user delete
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws GeneralException
     */
    public function restore($id)
    {
        $this->authorize('restore user');

        $this->userRepository->restore(User::withTrashed()->findOrFail($id));

        return redirect($this->redirectPath())
            ->withFlashSuccess(__('The user was successfully restored.'));
    }
}
