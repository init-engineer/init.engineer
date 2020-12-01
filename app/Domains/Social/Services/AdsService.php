<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Ads;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class AdsService.
 */
class AdsService extends BaseService
{
    /**
     * AdsService constructor.
     *
     * @param Ads $ads
     */
    public function __construct(Ads $ads)
    {
        $this->model = $ads;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerAds(array $data = []): Ads
    {
        DB::beginTransaction();

        try {
            $ads = $this->createAds($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your ads.'));
        }

        DB::commit();

        return $ads;
    }

    /**
     * @param array $data
     *
     * @return Ads
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Ads
    {
        DB::beginTransaction();

        try {
            $ads = $this->createAds([
                'model_id' => $data['model_id'],
                'name' => $data['name'],
                'ads_path' => $data['ads_path'] ?? null,
                'number_max' => $data['number_max'] ?? 0,
                'number_min' => $data['number_min'] ?? 0,
                'incidence' => $data['incidence'] ?? 0,
                'active' => $data['active'] ?? false,
                'payment' => $data['payment'] ?? false,
                'started_at' => $data['started_at'] ?? null,
                'ended_at' => $data['ended_at'] ?? null,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this ads. Please try again.'));
        }

        // event(new AdsCreated($ads));

        DB::commit();

        return $ads;
    }

    /**
     * @param Ads $ads
     * @param array $data
     *
     * @return Ads
     * @throws \Throwable
     */
    public function update(Ads $ads, array $data = []): Ads
    {
        DB::beginTransaction();

        try {
            $ads->update([
                'name' => $data['name'] ?? $ads->name,
                'number_max' => $data['number_max'] ?? $ads->number_max,
                'number_min' => $data['number_min'] ?? $ads->number_min,
                'incidence' => $data['incidence'] ?? $ads->incidence,
                'active' => $data['active'] ?? $ads->active,
                'payment' => $data['payment'] ?? $ads->payment,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this ads. Please try again.'));
        }

        // event(new AdsUpdated($ads));

        DB::commit();

        return $ads;
    }

    /**
     * @param Ads $ads
     * @param array $data
     *
     * @return Ads
     */
    public function updateStartEnded(Ads $ads, array $data = []): Ads
    {
        if (isset($data['started_at'])) $ads->started_at = $data['started_at'];
        if (isset($data['ended_at'])) $ads->ended_at = $data['ended_at'];

        return tap($ads)->save();
    }

    /**
     * @param Ads $ads
     * @param array $data
     *
     * @return Ads
     */
    public function updateBanner(Ads $ads, array $data = []): Ads
    {
        $ads->ads_path = $data['ads_path'];

        return tap($ads)->save();
    }

    /**
     * @param Ads $ads
     * @param $status
     *
     * @return Ads
     * @throws GeneralException
     */
    public function mark(Ads $ads, $status): Ads
    {
        $ads->active = $status;

        if ($ads->save()) {
            // event(new AdsStatusChanged($ads, $status));

            return $ads;
        }

        throw new GeneralException(__('There was a problem updating this ads. Please try again.'));
    }

    /**
     * @param Ads $ads
     *
     * @return Ads
     * @throws GeneralException
     */
    public function delete(Ads $ads): Ads
    {
        if ($this->deleteById($ads->id)) {
            // event(new AdsDeleted($ads));

            return $ads;
        }

        throw new GeneralException('There was a problem deleting this ads. Please try again.');
    }

    /**
     * @param Ads $ads
     *
     * @throws GeneralException
     * @return Ads
     */
    public function restore(Ads $ads): Ads
    {
        if ($ads->restore()) {
            // event(new AdsRestored($ads));

            return $ads;
        }

        throw new GeneralException(__('There was a problem restoring this ads. Please try again.'));
    }

    /**
     * @param Ads $ads
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Ads $ads): bool
    {
        if ($ads->forceDelete()) {
            // event(new AdsDestroyed($ads));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this ads. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Ads
     */
    protected function createAds(array $data = []): Ads
    {
        return $this->model::create([
            'model_type' => User::class,
            'model_id' => $data['model_id'],
            'name' => $data['name'],
            'ads_path' => $data['ads_path'],
            'number_max' => $data['number_max'] ?? 0,
            'number_min' => $data['number_min'] ?? 0,
            'incidence' => $data['incidence'] ?? 0,
            'active' => $data['active'] ?? false,
            'started_at' => $data['started_at'] ?? null,
            'ended_at' => $data['ended_at'] ?? null,
        ]);
    }
}
