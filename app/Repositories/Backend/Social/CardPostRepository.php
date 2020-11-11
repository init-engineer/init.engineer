<?php

namespace App\Repositories\Backend\Social;

use App\Exceptions\GeneralException;
use App\Models\Social\CardPost;
use App\Models\Social\Cards;
use App\Models\Social\Platform;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class CardPostRepository.
 */
class CardPostRepository extends BaseRepository
{
    /**
     * CardPostRepository constructor.
     *
     * @param CardPost $model
     */
    public function __construct(CardPost $model)
    {
        $this->model = $model;
    }

    /**
     * @param Platform $platform
     * @param Cards    $cards
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByPlatformCard(Platform $platform, Cards $cards)
    {
        $post = $this->model
            ->where('platform_id', $platform->id)
            ->where('card_id', $cards->id)
            ->first();

        if ($post instanceof $this->model) {
            return $post;
        }

        throw new GeneralException(__('exceptions.backend.social.card_post.not_found'));
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @return CardPost
     */
    public function create(array $data): CardPost
    {
        return DB::transaction(function () use ($data) {
            $post = $this->model::create([
                'card_id' => $data['card_id'],
                'platform_id' => $data['platform_id'],
                'social_card_id' => $data['social_card_id'],
                'num_like' => $data['num_like'] ?? 0,
                'num_share' => $data['num_share'] ?? 0,
                'active' => $data['active'] ?? false,
            ]);

            if ($post) {
                // event(new CardPostCreated($post));

                return $post;
            }

            throw new GeneralException(__('exceptions.backend.social.card_post.create_error'));
        });
    }

    /**
     * @param CardPost $post
     * @param array    $data
     *
     * @throws GeneralException
     * @return CardPost
     */
    public function update(CardPost $post, array $data): CardPost
    {
        return DB::transaction(function () use ($post, $data) {
            if ($post->update([
                'num_like' => $data['num_like'] ?? $post->num_like,
                'num_share' => $data['num_share'] ?? $post->num_share,
            ])) {
                // event(new CardPostUpdated($post));

                return $post;
            }

            throw new GeneralException(__('exceptions.backend.social.card_post.update_error'));
        });
    }

    /**
     * @param CardPost $post
     * @param          $status
     *
     * @throws GeneralException
     * @return CardPost
     */
    public function mark(CardPost $post, $status): CardPost
    {
        $post->active = $status;

        switch ($status) {
            case 0:
                // event(new CardPostDeactivated($user));
                break;
            case 1:
                // event(new CardPostReactivated($user));
                break;
        }

        if ($post->save()) {
            return $post;
        }

        throw new GeneralException(__('exceptions.backend.social.card_post.mark_error'));
    }

    /**
     * @param CardPost $post
     *
     * @throws GeneralException
     * @return CardPost
     */
    public function forceDelete(CardPost $post): CardPost
    {
        return DB::transaction(function () use ($post) {
            if ($post->forceDelete()) {
                // event(new CardPostPermanentlyDeleted($post));

                return $post;
            }

            throw new GeneralException(__('exceptions.backend.social.card_post.delete_error'));
        });
    }

    /**
     * @param CardPost $post
     *
     * @throws GeneralException
     * @return CardPost
     */
    public function restore(CardPost $post): CardPost
    {
        if ($post->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.social.card_post.cant_restore'));
        }

        if ($post->restore()) {
            // event(new CardPostRestored($post));

            return $post;
        }

        throw new GeneralException(__('exceptions.backend.social.card_post.restore_error'));
    }
}
