<?php

namespace App\Repositories\Backend\Social;

use App\Models\Social\MediaCards;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;

/**
 * Class MediaCardsRepository.
 */
class MediaCardsRepository extends BaseRepository
{
    /**
     * MediaCardsRepository constructor.
     *
     * @param MediaCards $model
     */
    public function __construct(MediaCards $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findById($id)
    {
        $cards = $this->model
            ->find($id);

        if ($cards instanceof $this->model) {
            return $cards;
        }

        // throw new GeneralException(__('exceptions.backend.social.media.cards.not_found'));
        return false;
    }

    /**
     * @param $card_id
     * @param $social_type
     * @param $social_connections
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByCardId($card_id, $social_type, $social_connections)
    {
        $cards = $this->model
            ->where('card_id', $card_id)
            ->where('social_type', $social_type)
            ->where('social_connections', $social_connections)
            ->first();

        if ($cards instanceof $this->model) {
            return $cards;
        }

        // throw new GeneralException(__('exceptions.backend.social.media.cards.not_found'));
        return false;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return MediaCards
     */
    public function create(array $data) : MediaCards
    {
        return DB::transaction(function () use ($data) {
            $cards = $this->model::create([
                'card_id' => $data['card_id'],
                'model_type' => isset($data['model_type'])? $data['model_type'] : 'App\Models\Auth\User',
                'model_id' => $data['model_id'],
                'social_type' => isset($data['social_type'])? $data['social_type'] : 'local',
                'social_connections' => isset($data['social_connections'])? $data['social_connections'] : 'local',
                'social_card_id' => isset($data['social_card_id'])? $data['social_card_id'] : $data['card_id'],
                'num_like' => isset($data['num_like'])? $data['num_like'] : 0,
                'num_share' => isset($data['num_share'])? $data['num_share'] : 0,
                'active' => isset($data['active'])? $data['active'] : true,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : false,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : null,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : null,
                'created_at' => isset($data['created_at'])? $data['created_at'] : null,
                'updated_at' => isset($data['updated_at'])? $data['updated_at'] : null,
                'deleted_at' => isset($data['deleted_at'])? $data['deleted_at'] : null,
            ]);

            if ($cards) {
                // event(new MediaCardsCreated($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.backend.social.media.cards.create_error'));
        });
    }

    /**
     * @param MediaCards $mediaCards
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return MediaCards
     */
    public function update(MediaCards $mediaCards, array $data) : MediaCards
    {
        return DB::transaction(function () use ($mediaCards, $data) {
            if ($mediaCards->update([
                'num_like' => isset($data['num_like'])? $data['num_like'] : $mediaCards->num_like,
                'num_share' => isset($data['num_share'])? $data['num_share'] : $mediaCards->num_share,
                'active' => isset($data['active'])? $data['active'] : $mediaCards->active,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : $mediaCards->is_banned,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : $mediaCards->banned_user_id,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : $mediaCards->banned_remarks,
            ])) {
                // event(new MediaCardsUpdated($mediaCards));

                return $mediaCards;
            }

            throw new GeneralException(__('exceptions.backend.social.media.cards.update_error'));
        });
    }
}
