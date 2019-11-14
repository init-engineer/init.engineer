<?php

namespace App\Repositories\Frontend\Social;

use App\Models\Social\Cards;
use App\Models\Social\Comments;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CommentsRepository.
 */
class CommentsRepository extends BaseRepository
{
    /**
     * CommentsRepository constructor.
     *
     * @param Comments $model
     */
    public function __construct(Comments $model)
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
        $comment = $this->model
            ->find($id);

        if ($comment instanceof $this->model) {
            return $comment;
        }

        throw new GeneralException(__('exceptions.frontend.social.comments.not_found'));
    }

    /**
     * @param Cards  $cards
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated(Cards $cards, $paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->where('card_id', $cards->id)
            ->whereNull('reply_media_comment_id')
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}
