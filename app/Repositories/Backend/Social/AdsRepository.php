<?php

namespace App\Repositories\Backend\Social;

use Carbon\Carbon;
use App\Models\Social\Ads;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class AdsRepository.
 */
class AdsRepository extends BaseRepository
{
    /**
     * AdsRepository constructor.
     *
     * @param Ads $model
     */
    public function __construct(Ads $model)
    {
        $this->model = $model;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findById($id)
    {
        $ads = $this->model
            ->find($id);

        if ($ads instanceof $this->model) {
            return $ads;
        }

        // throw new GeneralException(__('exceptions.frontend.social.cards.ads.not_found'));
        return false;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Ads
     */
    public function create(array $data) : Ads
    {
        return DB::transaction(function () use ($data) {
            $ads = $this->model::create([
                'name'         => $data['name'],
                'ads_path'     => $data['ads_path'],
                'number_count' => $data['number_count'] ?? 0,
                'number_max'   => $data['number_max']   ?? 0,
                'active'       => $data['active']       ?? true,
                'options'      => isset($data['options'])? json_encode($data['options']) : '{}',
                'started_at'   => $data['started_at']   ?? Carbon::now(),
                'end_at'       => $data['end_at']       ?? Carbon::now(),
            ]);

            if ($ads) {
                // event(new CardsAdsCreated($ads));

                return $ads;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.ads.create_error'));
        });
    }

    /**
     * @param Ads   $ads
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Ads
     */
    public function update(Ads $ads, array $data) : Ads
    {
        return DB::transaction(function () use ($ads, $data) {
            if ($ads->update([
                'name'         => isset($data['name'])?         $data['name']                 : $ads->name,
                'ads_path'     => isset($data['ads_path'])?     $data['ads_path']             : $ads->ads_path,
                'number_count' => isset($data['number_count'])? $data['number_count']         : $ads->number_count,
                'number_max'   => isset($data['number_max'])?   $data['number_max']           : $ads->number_max,
                'options'      => isset($data['options'])?      json_encode($data['options']) : $ads->options,
                'started_at'   => isset($data['started_at'])?   $data['started_at']           : $ads->started_at,
                'end_at'       => isset($data['end_at'])?       $data['end_at']               : $ads->end_at,
            ])) {
                // event(new CardsAdsUpdated($ads));

                return $ads;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.ads.update_error'));
        });
    }
}
