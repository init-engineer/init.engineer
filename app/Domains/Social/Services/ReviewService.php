<?php

namespace App\Domains\Social\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Reviews;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ReviewService.
 */
class ReviewService extends BaseService
{
    /**
     * ReviewService constructor.
     *
     * @param Reviews $reviews
     */
    public function __construct(Reviews $reviews)
    {
        $this->model = $reviews;
    }

    /**
     * @param Cards $cards
     * @param User $user
     *
     * @return array
     */
    public function haveVoted(Cards $cards, User $user): array
    {
        $review = $this->model
            ->where('model_id', $user->id)
            ->where('card_id', $cards->id)
            ->first();

        if ($review instanceof $this->model) {
            return [
                'voted' => true,
                'selector' => ($review->point > 0) ? true : false,
            ];
        }

        return [
            'voted' => false,
        ];
    }

    /**
     * @param Cards $cards
     *
     * @return int
     */
    public function findYesByVoted(Cards $cards): int
    {
        $count = $this->model
            ->where('card_id', $cards->id)
            ->where('point', '>', 0)
            ->count();

        return $count;
    }

    /**
     * @param Cards $cards
     *
     * @return int
     */
    public function findNoByVoted(Cards $cards): int
    {
        $count = $this->model
            ->where('card_id', $cards->id)
            ->where('point', '<', 0)
            ->count();

        return $count;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerReview(array $data = []): Reviews
    {
        DB::beginTransaction();

        try {
            $review = $this->createReview($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your review.'));
        }

        DB::commit();

        return $review;
    }

    /**
     * @param array $data
     *
     * @return Reviews
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): Reviews
    {
        DB::beginTransaction();

        try {
            $review = $this->createReview([
                'model_id' => $data['model_id'],
                'card_id' => $data['card_id'],
                'point' => $data['point'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this review. Please try again.'));
        }

        // event(new ReviewCreated($review));

        DB::commit();

        return $review;
    }

    /**
     * @param Reviews $review
     *
     * @return Reviews
     * @throws GeneralException
     */
    public function delete(Reviews $review): Reviews
    {
        if ($this->deleteById($review->id)) {
            // event(new ReviewDeleted($review));

            return $review;
        }

        throw new GeneralException('There was a problem deleting this review. Please try again.');
    }

    /**
     * @param Reviews $review
     *
     * @throws GeneralException
     * @return Reviews
     */
    public function restore(Reviews $review): Reviews
    {
        if ($review->restore()) {
            // event(new ReviewRestored($review));

            return $review;
        }

        throw new GeneralException(__('There was a problem restoring this review. Please try again.'));
    }

    /**
     * @param Reviews $review
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Reviews $review): bool
    {
        if ($review->forceDelete()) {
            // event(new ReviewDestroyed($review));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this review. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Reviews
     */
    protected function createReview(array $data = []): Reviews
    {
        return $this->model::create([
            'model_type' => User::class,
            'model_id' => $data['model_id'],
            'card_id' => $data['card_id'],
            'point' => $data['point'],
            'config' => isset($data['config']) ? json_encode($data['config']) : '{}',
        ]);
    }
}
