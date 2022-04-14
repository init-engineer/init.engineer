<?php

namespace App\Domains\Announcement\Http\Controllers\Backend;

use App\Domains\Announcement\Http\Requests\Backend\DeleteAnnouncementRequest;
use App\Domains\Announcement\Http\Requests\Backend\EditAnnouncementRequest;
use App\Domains\Announcement\Http\Requests\Backend\StoreAnnouncementRequest;
use App\Domains\Announcement\Http\Requests\Backend\UpdateAnnouncementRequest;
use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Services\AnnouncementService;
use App\Http\Controllers\Controller;

/**
 * Class AnnouncementController.
 *
 * @extends Controller
 */
class AnnouncementController extends Controller
{
    /**
     * @var AnnouncementService
     */
    protected $service;

    /**
     * AnnouncementController constructor.
     *
     * @param AnnouncementService $service
     */
    public function __construct(AnnouncementService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.announcement.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.announcement.create');
    }

    /**
     * @param StoreAnnouncementRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.announcement.index')
            ->withFlashSuccess(__('The announcement was successfully created.'));
    }

    /**
     * @param EditAnnouncementRequest $request
     * @param Announcement $announcement
     *
     * @return mixed
     */
    public function edit(EditAnnouncementRequest $request, Announcement $announcement)
    {
        return view('backend.announcement.edit')
            ->with('announcement', $announcement);
    }

    /**
     * @param UpdateAnnouncementRequest $request
     * @param Announcement $announcement
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $this->service->update($announcement, $request->validated());

        return redirect()
            ->route('admin.announcement.index')
            ->withFlashSuccess(__('The announcement was successfully updated.'));
    }

    /**
     * @param DeleteAnnouncementRequest $request
     * @param Announcement $announcement
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteAnnouncementRequest $request, Announcement $announcement)
    {
        $this->service->delete($announcement);

        return redirect()
            ->route('admin.announcement.index')
            ->withFlashSuccess(__('The announcement was successfully deleted.'));
    }
}
