<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

/**
 * Class SocialController.
 *
 * @extends Controller
 */
class SocialController extends Controller
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
     * @param  UserService  $userService
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\GeneralException
     */
    public function callback($provider, UserService $userService)
    {
        try {
            $user = $userService->registerProvider(Socialite::driver($provider)->user(), $provider);
        } catch (InvalidStateException $exception) {
            session()->increment($provider . '_socialite_attempt_count');

            if (session($provider . '_socialite_attempt_count') > 2) {
                return redirect('/');
            }

            return redirect(route('frontend.auth.social.login', $provider));
        }

        if (! $user->isActive()) {
            auth()->logout();

            return redirect()
                ->route('frontend.auth.login')
                ->withFlashDanger(__('Your account has been deactivated.'));
        }

        auth()->login($user);

        event(new UserLoggedIn($user));

        return redirect()
            ->route(homeRoute());
    }
}
