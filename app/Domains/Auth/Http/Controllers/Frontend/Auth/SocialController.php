<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Redirect;

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
        } catch (Exception $e) {
            return redirect()
                ->route('frontend.auth.login')
                ->withFlashDanger(__('Your account is not bind to any community account.'));
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
