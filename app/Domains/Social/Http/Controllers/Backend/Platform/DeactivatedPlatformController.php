<?php

namespace App\Domains\Social\Http\Controllers\Backend\Platform;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\PlatformService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedPlatformController.
 */
class DeactivatedPlatformController extends Controller
{
    /**
     * @var PlatformService
     */
    protected $platformService;

    /**
     * DeactivatedPlatformController constructor.
     *
     * @param PlatformService $platformService
     */
    public function __construct(PlatformService $platformService)
    {
        $this->platformService = $platformService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.platform.deactivated');
    }

    /**
     * @param Request $request
     * @param Platform $platform
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Platform $platform, $status)
    {
        $this->platformService->mark($platform, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.social.platform.reactivate') ?
                'admin.social.platform.index' :
                'admin.social.platform.deactivated'
        )->withFlashSuccess(__('The platform was successfully updated.'));
    }
}
