<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Cards;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                'probability' => $data['probability'] ?? 0,
                'payment' => $data['payment'] ?? false,
                'active' => $data['active'] ?? false,
                'starts_at' => $data['starts_at'] ?? null,
                'ends_at' => $data['ends_at'] ?? null,
            ]);

            if (isset($data['ads_banner'])) {
                $ads->setPicture(array(
                    'storage' => $data['ads_banner']->store('/ads/banner', 'public'),
                ));
            }
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
                'probability' => $data['probability'] ?? $ads->probability,
                'payment' => isset($data['payment']) ? true : false,
                'active' => isset($data['active']) ? true : false,
                'starts_at' => isset($data['starts_at']) ? $data['starts_at'] . ' 12:00:00' : $ads->starts_at,
                'ends_at' => isset($data['ends_at']) ? $data['ends_at'] . ' 12:00:00' : $ads->ends_at,
            ]);

            if (isset($data['ads_banner'])) {
                $pictureJson = $ads->getPictureJson();
                $url = $pictureJson['storage'];
                if ($url !== 'img/default/banner-ads.png') {
                    Storage::disk('public')->delete($url);
                }

                $ads->setPicture(array(
                    'storage' => $data['ads_banner']->store('/ads/banner', 'public'),
                ));
            }
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
     * @param Cards $cards
     *
     * @return Ads
     * @throws GeneralException
     */
    public function deploy(Ads $ads, Cards $cards)
    {
        $deploy = json_decode($ads->deploy, true);
        array_push($deploy, $cards->uuid);
        $ads->deploy = json_encode($deploy);

        if ($ads->save()) {
            // event(new AdsDeploy($ads, $cards));

            return $ads;
        }

        throw new GeneralException(__('There was a problem updating this ads. Please try again.'));
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
            'probability' => $data['probability'] ?? 0,
            'payment' => $data['payment'] ?? false,
            'active' => $data['active'] ?? false,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
        ]);
    }
}
