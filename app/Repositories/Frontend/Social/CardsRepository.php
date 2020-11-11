<?php

namespace App\Repositories\Frontend\Social;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class CardsRepository.
 */
class CardsRepository extends BaseRepository
{
    /**
     * CardsRepository constructor.
     *
     * @param Cards $model
     */
    public function __construct(Cards $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @return Cards
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $cards = $this->model::create(array(
                'model_type' => User::class,
                'model_id' => $data['model_id'],
                'content' => $data['content'],
                'config' => json_encode($data['config']),
                'active' => false,
            ));

            if ($cards) {
                // event(new CardsCreated($cards));

                return $cards;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.create_error'));
        });
    }
}
