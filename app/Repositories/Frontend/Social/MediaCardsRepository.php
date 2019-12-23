<?php

namespace App\Repositories\Frontend\Social;

use App\Models\Auth\User;
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
    public function findByCardId($id, $type, $connections)
    {
        $media = $this->model
            ->active()
            ->where('card_id', $id)
            ->where('social_type', $type)
            ->where('social_connections', $connections)
            ->first();

        if ($media instanceof $this->model) {
            return $media;
        }

        throw new GeneralException(__('exceptions.frontend.social.media.cards.not_found'));
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
            $media = $this->model::create([
                'card_id' => $data['card_id'],
                'model_type' => isset($data['model_type'])? $data['model_type'] : User::class,
                'model_id' => $data['model_id'],
                'social_type' => $data['social_type'],
                'social_connections' => $data['social_connections'],
                'social_card_id' => $data['social_card_id'],
            ]);

            if ($media) {
                // event(new MediaCardsCreated($media));

                return $media;
            }

            throw new GeneralException(__('exceptions.frontend.social.media.cards.create_error'));
        });
    }
}
