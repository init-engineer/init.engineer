<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Models\Auth\User;
use App\Models\Auth\SocialAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Repositories\Backend\Auth\SocialRepository;

/**
 * Class UserSocialController.
 */
class UserSocialController extends Controller
{
    /**
     * @var SocialRepository
     */
    protected $socialRepository;

    /**
     * UserSocialController constructor.
     *
     * @param SocialRepository $socialRepository
     */
    public function __construct(SocialRepository $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     * @param SocialAccount     $social
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function unlink(ManageUserRequest $request, User $user, SocialAccount $social)
    {
        $this->socialRepository->delete($user, $social);

        return redirect()->back()->withFlashSuccess(__('alerts.backend.users.social_deleted'));
    }
}
