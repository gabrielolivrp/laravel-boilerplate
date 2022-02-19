<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Login;

class LoginSocialController extends Controller
{
    /**
     * @param $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @param UserRepository $userRepository
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function callback($provider, UserRepository $userRepository)
    {
        $user = $userRepository->registerProvider(Socialite::driver($provider)->user(), $provider);

//        if (! $user->isActive()) {
//            auth()->logout();
//
//            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
//        }

        auth()->login($user);

        event(new Login(auth()->guard(), $user, false));

        return redirect()->intended(homeRoute());
    }
}
