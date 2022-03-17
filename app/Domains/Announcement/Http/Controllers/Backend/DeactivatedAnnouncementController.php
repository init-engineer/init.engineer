<?php

namespace App\Domains\Announcement\Http\Controllers\Backend;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Services\AnnouncementService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class DeactivatedAnnouncementController.
 *
 * @extends Controller
 */
class DeactivatedAnnouncementController extends Controller
{
    /**
     * @var AnnouncementService
     */
    protected $service;

    /**
     * DeactivatedAnnouncementController constructor.
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
        return view('backend.announcement.deactivated');
    }

    /**
     * @param Request $request
     * @param Announcement $announcement
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Request $request, Announcement $announcement, $status)
    {
        $this->service->mark($announcement, (int) $status);

        return redirect()->route(
            (int) $status === 1 || ! $request->user()->can('admin.announcement.reactivate') ?
                'admin.announcement.index' :
                'admin.announcement.deactivated'
        )->withFlashSuccess(__('The announcement was successfully updated.'));
    }
}
