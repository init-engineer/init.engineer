<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class TwoFactorAuthenticationController.
 *
 * @extends Controller
 */
class TwoFactorAuthenticationController extends Controller
{
    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $secret = $request->user()->createTwoFactorAuth();

        return view('frontend.user.account.tabs.two-factor-authentication.enable')
            ->with('qrCode', $secret->toQr())
            ->with('secret', $secret->toString());
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function show(Request $request)
    {
        return view('frontend.user.account.tabs.two-factor-authentication.recovery')
            ->with('recoveryCodes', $request->user()->getRecoveryCodes());
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        $request->user()->generateRecoveryCodes();

        session()->flash('flash_warning', __('Any old backup codes have been invalidated.'));

        return redirect()
            ->route('frontend.auth.account.2fa.show')
            ->withFlashSuccess(__('Two Factor Recovery Codes Regenerated'));
    }
}
