<?php

namespace App\Domains\Social\Http\Controllers\Backend\Platform;

use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\PlatformService;
use App\Http\Controllers\Controller;

/**
 * Class DeletedPlatformController.
 */
class DeletedPlatformController extends Controller
{
    /**
     * @var PlatformService
     */
    protected $platformService;

    /**
     * DeletedPlatformController constructor.
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
        return view('backend.social.platform.deleted');
    }

    /**
     * @param Platform $deletedPlatform
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Platform $deletedPlatform)
    {
        $this->platformService->restore($deletedPlatform);

        return redirect()->route('admin.social.platform.index')->withFlashSuccess(__('The platform was successfully restored.'));
    }

    /**
     * @param Platform $deletedPlatform
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Platform $deletedPlatform)
    {
        $this->platformService->destroy($deletedPlatform);

        return redirect()->route('admin.social.platform.deleted')->withFlashSuccess(__('The platform was permanently deleted.'));
    }
}
