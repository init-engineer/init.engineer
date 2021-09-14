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
     * @return \Illuminate\View\View
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
        $this->platformService->store($request->validated());

        return redirect()->route('admin.social.platform.index')->withFlashSuccess(__('The platform was successfully created.'));
    }

    /**
     * @return mixed
     */
    public function show()
    {
        return redirect()->route('admin.social.platform.index');
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
            ->with('platform', $platform)
            ->with('config', $platform->config);
    }

    /**
     * @param UpdatePlatformRequest $request
     * @param Platform $platform
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        $this->platformService->update($platform, $request->validated());

        return redirect()->route('admin.social.platform.index')->withFlashSuccess(__('The platform was successfully updated.'));
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
