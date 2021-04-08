<?php

namespace App\Domains\Announcement\Http\Controllers\Backend;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Services\AnnouncementService;
use App\Http\Controllers\Controller;

/**
 * Class DeletedAnnouncementController.
 */
class DeletedAnnouncementController extends Controller
{
    /**
     * @var AnnouncementService
     */
    protected $service;

    /**
     * DeletedAnnouncementController constructor.
     *
     * @param AnnouncementService $service
     */
    public function __construct(AnnouncementService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.announcement.deleted');
    }

    /**
     * @param Announcement $deletedAnnouncement
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Announcement $deletedAnnouncement)
    {
        $this->service->restore($deletedAnnouncement);

        return redirect()->route('admin.announcement.index')->withFlashSuccess(__('The announcement was successfully restored.'));
    }

    /**
     * @param Announcement $deletedAnnouncement
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Announcement $deletedAnnouncement)
    {
        $this->service->destroy($deletedAnnouncement);

        return redirect()->route('admin.announcement.deleted')->withFlashSuccess(__('The announcement was permanently deleted.'));
    }
}
