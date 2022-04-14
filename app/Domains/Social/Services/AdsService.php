<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Ads;
use App\Domains\Social\Models\Cards;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdsService.
 *
 * @extends BaseService
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
     * 隨機抽選有效的廣告
     *
     * @return array
     */
    public function random(): array
    {
        /**
         * 取得目前有效的廣告列表
         */
        $ads = $this->model
            ->where('starts_at', '<=', Carbon::now())
            ->where('ends_at', '>=', Carbon::now())
            ->active()
            ->get();

        /**
         * 如果目前沒有廣告，就結束抽選
         */
        if (count($ads) === 0) {
            return [
                // 是否被置入廣告
                'result' => false,
            ];
        }

        /**
         * 定義 result 回傳資料，以及 incidence 機率暫存器
         */
        $result = [
            // 是否被置入廣告
            'result' => false,
            // 抽選到的機率，區間為 0 ~ 10000
            'lottery' => rand(0, 10000),
            // 這次抽選時，所採納的廣告
            'ads' => [],
            // 如果有抽中廣告的話
            'data' => null,
        ];
        $incidence = 0;

        /**
         * 逐一計算與抽選廣告
         */
        foreach ($ads as $ad) {
            /**
             * 將廣告資訊新增至 result['ads'] 當中
             */
            array_push($result['ads'], [
                'id' => $ad->id,
                'type' => $ad->type,
                'name' => $ad->name,
                'content' => $ad->content,
                'picture' => $ad->picture,
                'probability' => $ad->probability,
                'render' => $ad->render,
                'starts_at' => $ad->starts_at->timestamp,
                'ends_at' => $ad->ends_at->timestamp,
            ]);

            /**
             * 計算廣告部屬機率區間
             * $min => 機率暫存器
             * $max => 機率暫存器 + 當前廣告部屬機率
             */
            $min = $incidence;
            $max = $incidence + $ad->probability;

            /**
             * 判斷抽選到的機率是否有著落在廣告部屬機率當中
             */
            if ($result['lottery'] >= $min && $result['lottery'] <= $max) {
                $result['result'] = true;
                $result['data'] = [
                    'id' => $ad->id,
                    'type' => $ad->type,
                    'name' => $ad->name,
                    'content' => $ad->content,
                    'picture' => $ad->picture,
                    'probability' => $ad->probability,
                    'render' => $ad->render,
                    'starts_at' => $ad->starts_at->timestamp,
                    'ends_at' => $ad->ends_at->timestamp,
                ];
            }

            /**
             * 累加機率暫存器
             */
            $incidence = $max;
        }

        /**
         * 將廣告結果回傳
         */
        return $result;
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
                'type' => $data['type'],
                'name' => $data['name'],
                'content' => $data['content'] ?? null,
                'probability' => $data['probability'] ?? 0,
                'render' => $data['render'] ?? false,
                'payment' => $data['payment'] ?? false,
                'active' => $data['active'] ?? false,
                'starts_at' => $data['starts_at'] ?? null,
                'ends_at' => $data['ends_at'] ?? null,
            ]);

            if (isset($data['ads_banner'])) {
                $ads->setPicture([
                    'storage' => $data['ads_banner']->store('/ads/banner', 'public'),
                ]);
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
                'type' => $data['type'] ?? $ads->type,
                'name' => $data['name'] ?? $ads->name,
                'content' => $data['content'] ?? $ads->content,
                'probability' => $data['probability'] ?? $ads->probability,
                'render' => isset($data['render']) ? true : false,
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

                $ads->setPicture([
                    'storage' => $data['ads_banner']->store('/ads/banner', 'public'),
                ]);
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
        $deploy = $ads->deploy;
        array_push($deploy, $cards->uuid);
        $ads->deploy = $deploy;

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
            'type' => $data['type'],
            'name' => $data['name'],
            'content' => $data['content'] ?? null,
            'probability' => $data['probability'] ?? 0,
            'render' => $data['render'] ?? false,
            'payment' => $data['payment'] ?? false,
            'active' => $data['active'] ?? false,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
        ]);
    }
}
