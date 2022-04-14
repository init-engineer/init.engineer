<?php

namespace App\Domains\Social\Services;

use App\Domains\Social\Models\Comments;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentsService.
 */
class CommentsService extends BaseService
{
    /**
     * CommentsService constructor.
     *
     * @param Comments $comment
     */
    public function __construct(Comments $comment)
    {
        $this->model = $comment;
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function findCommentById(string $id)
    {
        $comment = $this->model
            ->where('comment_id', $id)
            ->first();

        if ($comment instanceof $this->model) {
            return $comment;
        }

        return false;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerComment(array $data = []): Comments
    {
        DB::beginTransaction();

        try {
            $comment = $this->createComment($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating your comment.'));
        }

        DB::commit();

        return $comment;
    }

    /**
     * @param array $data
     *
     * @return Comments
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data): Comments
    {
        DB::beginTransaction();

        try {
            $comment = $this->createComment([
                'card_id' => $data['card_id'],
                'platform_id' => $data['platform_id'] ?? null,
                'platform_card_id' => $data['platform_card_id'] ?? null,
                'comment_id' => $data['comment_id'] ?? null,
                'user_name' => $data['user_name'] ?? '匿名',
                'user_id' => $data['user_id'] ?? null,
                'user_avatar' => $data['user_avatar'] ?? null,
                'content' => $data['comments'] ?? $data['content'] ?? null,
                'reply' => $data['reply'] ?? null,
                'created_at' => $data['created_at'] ?? null,
                'updated_at' => $data['updated_at'] ?? null,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this comment. Please try again.'));
        }

        // event(new CommentCreated($comment));

        DB::commit();

        return $comment;
    }

    /**
     * @param Comments $comment
     *
     * @return Comments
     * @throws GeneralException
     */
    public function delete(Comments $comment): Comments
    {
        if ($this->deleteById($comment->id)) {
            // event(new CommentDeleted($comment));

            return $comment;
        }

        throw new GeneralException('There was a problem deleting this comment. Please try again.');
    }

    /**
     * @param Comments $comment
     *
     * @throws GeneralException
     * @return Comments
     */
    public function restore(Comments $comment): Comments
    {
        if ($comment->restore()) {
            // event(new CommentRestored($comment));

            return $comment;
        }

        throw new GeneralException(__('There was a problem restoring this comment. Please try again.'));
    }

    /**
     * @param Comments $comment
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Comments $comment): bool
    {
        if ($comment->forceDelete()) {
            // event(new CommentDestroyed($comment));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this comment. Please try again.'));
    }

    /**
     * @param array $data
     *
     * @return Comments
     */
    protected function createComment(array $data = []): Comments
    {
        return $this->model::create([
            'card_id' => $data['card_id'],
            'platform_id' => $data['platform_id'] ?? null,
            'platform_card_id' => $data['platform_card_id'] ?? null,
            'comment_id' => $data['comment_id'] ?? null,
            'user_name' => $data['user_name'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'user_avatar' => $data['user_avatar'] ?? '/img/frontend/user/nopic_192.gif',
            'content' => $data['content'] ?? null,
            'reply' => $data['reply'] ?? null,
            'created_at' => $data['created_at'] ?? Carbon::now(),
            'updated_at' => $data['updated_at'] ?? Carbon::now(),
        ]);
    }
}
