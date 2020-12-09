<?php

namespace App\Domains\Social\Http\Controllers\Backend\Platform;

use App\Domains\Social\Http\Requests\Backend\Platform\DeletePlatformRequest;
use App\Domains\Social\Http\Requests\Backend\Platform\EditPlatformRequest;
use App\Domains\Social\Http\Requests\Backend\Platform\StorePlatformRequest;
use App\Domains\Social\Http\Requests\Backend\Platform\UpdatePlatformRequest;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\PlatformService;
use App\Http\Controllers\Controller;

/**
 * Class PlatformController.
 */
class PlatformController extends Controller
{
    /**
     * @var PlatformService
     */
    protected $platformService;

    /**
     * PlatformController constructor.
     *
     * @param PlatformService $platformService
     */
    public function __construct(PlatformService $platformService)
    {
        $this->platformService = $platformService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.social.platform.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.social.platform.create');
    }

    /**
     * @param StorePlatformRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StorePlatformRequest $request)
    {
        $platform = $this->platformService->store($request->validated());

        return redirect()->route('admin.social.platform.show', $platform)->withFlashSuccess(__('The platform was successfully created.'));
    }

    /**
     * @param Platform $platform
     *
     * @return mixed
     */
    public function show(Platform $platform)
    {
        return view('backend.social.platform.show')
            ->withPlatform($platform);
    }

    /**
     * @param EditPlatformRequest $request
     * @param Platform $platform
     *
     * @return mixed
     */
    public function edit(EditPlatformRequest $request, Platform $platform)
    {
        return view('backend.social.platform.edit')
            ->withPlatform($platform)
            ->withConfig(json_decode($platform->config, true));
    }

    /**
     * @param UpdateAdsRequest $request
     * @param Platform $platform
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        $this->platformService->update($platform, $request->validated());

        return redirect()->route('admin.social.platform.show', $platform)->withFlashSuccess(__('The platform was successfully updated.'));
    }

    /**
     * @param DeletePlatformRequest $request
     * @param Platform $platform
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeletePlatformRequest $request, Platform $platform)
    {
        $this->platformService->delete($platform);

        return redirect()->route('admin.social.platform.deleted')->withFlashSuccess(__('The platform was successfully deleted.'));
    }
}
