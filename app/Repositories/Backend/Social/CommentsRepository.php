<?php

namespace App\Repositories\Backend\Social;

use App\Models\Social\Comments;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;

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
        $comments = $this->model
            ->find($id);

        if ($comments instanceof $this->model) {
            return $comments;
        }

        // throw new GeneralException(__('exceptions.backend.social.media.comments.not_found'));
        return false;
    }

    /**
     * @param $card_id
     * @param $media_id
     * @param $media_comment_id
     * @param $user_id
     * @param $content
     *
     * @throws GeneralException
     * @return mixed
     */
    public function findByMediaAndUserAndContent($card_id, $media_id, $media_comment_id, $user_id, $content)
    {
        $comments = $this->model
            ->where('card_id', $card_id)
            ->where('media_id', $media_id)
            ->where('media_comment_id', $media_comment_id)
            ->where('user_id', $user_id)
            ->where('content', $content)
            ->first();

        if ($comments instanceof $this->model) {
            return $comments;
        }

        // throw new GeneralException(__('exceptions.backend.social.media.comments.not_found'));
        return false;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return Comments
     */
    public function create(array $data) : Comments
    {
        return DB::transaction(function () use ($data) {
            $comments = $this->model::create([
                'card_id' => $data['card_id'],
                'media_id' => $data['media_id'],
                'media_comment_id' => $data['media_comment_id'],
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'user_avatar' => isset($data['user_avatar'])? $data['user_avatar'] : 'https://i.imgur.com/K7vQEM6.png',
                'content' => $data['content'],
                'active' => isset($data['active'])? $data['active'] : true,
                'reply_media_comment_id' => isset($data['reply_media_comment_id'])? ($data['reply_media_comment_id'] != '')? $data['reply_media_comment_id'] : null : null,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : false,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : null,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : null,
                'banned_at' => isset($data['banned_at'])? $data['banned_at'] : null,
                'created_at' => isset($data['created_at'])? $data['created_at'] : null,
                'updated_at' => isset($data['updated_at'])? $data['updated_at'] : null,
                'deleted_at' => isset($data['deleted_at'])? $data['deleted_at'] : null,
            ]);

            if ($comments) {
                // event(new CommentsCreated($comments));

                return $comments;
            }

            throw new GeneralException(__('exceptions.backend.social.media.comments.create_error'));
        });
    }

    /**
     * @param Comments $comments
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return Comments
     */
    public function update(Comments $comments, array $data) : Comments
    {
        return DB::transaction(function () use ($comments, $data) {
            if ($comments->update([
                'content' => isset($data['content'])? $data['content'] : $comments->content,
                'active' => isset($data['active'])? $data['active'] : $comments->active,
                'reply_media_comment_id' => isset($data['reply_media_comment_id'])? $data['reply_media_comment_id'] : $comments->reply_media_comment_id,
                'is_banned' => isset($data['is_banned'])? $data['is_banned'] : $comments->is_banned,
                'banned_user_id' => isset($data['banned_user_id'])? $data['banned_user_id'] : $comments->banned_user_id,
                'banned_remarks' => isset($data['banned_remarks'])? $data['banned_remarks'] : $comments->banned_remarks,
                'banned_at' => isset($data['banned_at'])? $data['banned_at'] : $comments->banned_at,
            ])) {
                // event(new CommentsUpdated($comments));

                return $comments;
            }

            throw new GeneralException(__('exceptions.backend.social.media.comments.update_error'));
        });
    }
}
