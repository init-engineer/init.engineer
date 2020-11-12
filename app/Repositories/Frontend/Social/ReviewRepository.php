<?php

namespace App\Repositories\Frontend\Social;

use App\Exceptions\GeneralException;
use App\Models\Social\Review;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class ReviewRepository.
 */
class ReviewRepository extends BaseRepository
{
    /**
     * ReviewRepository constructor.
     *
     * @param Review $model
     */
    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    /**
     * @param $cardId
     * @param $userId
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByCardId($cardId, $userId)
    {
        $review = $this->model
            ->where('card_id', $cardId)
            ->where('model_id', $userId)
            ->first();

        if ($review instanceof $this->model) {
            return $review;
        }

        // throw new GeneralException(__('exceptions.frontend.social.cards.review.not_found'));

        return false;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Review
     */
    public function create(array $data) : Review
    {
        return DB::transaction(function () use ($data) {
            $review = $this->model::create([
                'card_id' => $data['card_id'],
                'model_type' => isset($data['model_type'])? $data['model_type'] : User::class,
                'model_id' => $data['model_id'],
                'point' => $data['point'] ?? 0,
                'roles' => json_encode($data['roles']) ?? json_encode([]),
            ]);

            if ($review) {
                // event(new CardsReviewCreated($review));

                return $review;
            }

            throw new GeneralException(__('exceptions.frontend.social.cards.review.create_error'));
        });
    }
}
