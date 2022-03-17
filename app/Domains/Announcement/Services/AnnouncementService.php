<?php

namespace App\Domains\Announcement\Services;

use App\Domains\Announcement\Models\Announcement;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class AnnouncementService.
 *
 * @extends BaseService
 */
class AnnouncementService extends BaseService
{
    /**
     * AnnouncementService constructor.
     *
     * @param Announcement $announcement
     */
    public function __construct(Announcement $announcement)
    {
        $this->model = $announcement;
    }

    /**
     * Get all the enabled announcements
     * For the frontend or globally
     * Where there's either no time frame or
     * if there is a start and end date, make sure the current time is in between that or
     * if there is only a start date, make sure the current time is past that or
     * if there is only an end date, make sure the current time is before that.
     *
     * @return mixed
     */
    public function getForFrontend()
    {
        return $this->model::enabled()
            ->forArea(Announcement::AREA_FRONTEND)
            ->inTimeFrame()
            ->get();
    }

    /**
     * Get all the enabled announcements
     * For the backend or globally
     * Where there's either no time frame or
     * if there is a start and end date, make sure the current time is in between that or
     * if there is only a start date, make sure the current time is past that or
     * if there is only an end date, make sure the current time is before that.
     *
     * @return mixed
     */
    public function getForBackend()
    {
        return $this->model::enabled()
            ->forArea(Announcement::AREA_BACKEND)
            ->inTimeFrame()
            ->get();
    }

    /**
     * @param  array  $data
     *
     * @return Announcement
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Announcement
    {
        DB::beginTransaction();

        try {
            $starts_at = ($data['starts_at_date'] !== null) ? $data['starts_at_date'] . ' ' . $data['starts_at_time'] : null;
            $ends_at = ($data['ends_at_date'] !== null) ? $data['ends_at_date'] . ' ' . $data['ends_at_time'] : null;
            $announcement = $this->createAnnouncement([
                'type' => $data['type'],
                'area' => $data['area'],
                'message' => $data['message'],
                'starts_at' => $starts_at,
                'ends_at' => $ends_at,
                'enabled' => isset($data['enabled']) && $data['enabled'] === '1',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this announcement. Please try again.'));
        }

        // event(new AnnouncementCreated($announcement));

        DB::commit();

        return $announcement;
    }

    /**
     * @param Announcement $announcement
     * @param array $data
     *
     * @return Announcement
     * @throws \Throwable
     */
    public function update(Announcement $announcement, array $data = []): Announcement
    {
        DB::beginTransaction();

        try {
            $starts_at = ($data['starts_at_date'] !== null) ? $data['starts_at_date'] . ' ' . $data['starts_at_time'] : null;
            $ends_at = ($data['ends_at_date'] !== null) ? $data['ends_at_date'] . ' ' . $data['ends_at_time'] : null;
            $announcement->update([
                'type' => $data['type'],
                'area' => ($data['area'] !== 'all') ? $data['area'] : null,
                'message' => $data['message'],
                'starts_at' => $starts_at,
                'ends_at' => $ends_at,
                'enabled' => isset($data['enabled']) && $data['enabled'] === '1',
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this announcement. Please try again.'));
        }

        // event(new AnnouncementUpdated($announcement));

        DB::commit();

        return $announcement;
    }

    /**
     * @param Announcement $announcement
     * @param $status
     *
     * @return Announcement
     * @throws GeneralException
     */
    public function mark(Announcement $announcement, $status): Announcement
    {
        $announcement->enabled = $status;

        if ($announcement->save()) {
            // event(new AnnouncementEnabledChanged($announcement, $status));

            return $announcement;
        }

        throw new GeneralException(__('There was a problem updating this announcement. Please try again.'));
    }

    /**
     * @param Announcement $announcement
     *
     * @return Announcement
     * @throws GeneralException
     */
    public function delete(Announcement $announcement): Announcement
    {
        if ($announcement->delete()) {
            // event(new AnnouncementDeleted($announcement));

            return $announcement;
        }

        throw new GeneralException('There was a problem deleting this announcement. Please try again.');
    }

    /**
     * @param  array  $data
     *
     * @return Announcement
     */
    protected function createAnnouncement(array $data = []): Announcement
    {
        return $this->model::create([
            'type' => $data['type'] ?? Announcement::TYPE_PRIMARY,
            'area' => ($data['area'] !== 'all') ? $data['area'] : null,
            'message' => $data['message'] ?? null,
            'starts_at' => isset($data['starts_at']) ? $data['starts_at'] : null,
            'ends_at' => isset($data['ends_at']) ? $data['ends_at'] : null,
            'enabled' => $data['enabled'] ?? false,
        ]);
    }
}
