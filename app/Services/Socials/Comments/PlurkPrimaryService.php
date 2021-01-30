<?php

namespace App\Services\Socials\Comments;

use Exception;
use Qlurk\ApiClient;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Repositories\Backend\Social\CommentsRepository;
use App\Repositories\Backend\Social\MediaCardsRepository;

/**
 * Class PlurkPrimaryService.
 */
class PlurkPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var ApiClient
     */
    protected $plurk;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepository;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * PlurkPrimaryService constructor.
     */
    public function __construct(CommentsRepository $commentsRepository, MediaCardsRepository $mediaCardsRepository)
    {
        $this->commentsRepository = $commentsRepository;
        $this->mediaCardsRepository = $mediaCardsRepository;
        $this->plurk = new ApiClient(
            env('PLURK_CLIENT_ID'),
            env('PLURK_CLIENT_SECRET'),
            env('PLURK_TOKEN'),
            env('PLURK_TOKEN_SECRET')
        );
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function getComments(Cards $cards)
    {
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'plurk', 'primary')) {
            try {
                $response = $this->plurk->call('/APP/Responses/get', [
                    'plurk_id' => base_convert($mediaCards->social_card_id, 36, 10),
                    'count'    => 'all'
                ]);

                foreach ($response['responses'] as $reply) {
                    $profile = $this->plurk->call('/APP/Profile/getPublicProfile', ['user_id' => $reply['user_id']]);
                    $reply = array_merge($reply, $profile);
                    $this->write(array_merge($reply, [
                        'card_id' => $cards->id,
                        'media_card_id' => $mediaCards->id,
                        'media_comment_id' => sprintf('%s_%s', $reply['plurk_id'], $reply['id']),
                    ]));
                }
            } catch (Exception $e) {
                \Log::error($e->getMessage());
            }
        }
    }

    /**
     * @param array $data
     */
    private function write(array $data)
    {
        if ($comment = $this->commentsRepository->findBySocialId($data['card_id'], $data['media_card_id'], $data['media_comment_id'])) {
            if ($comment->content != $data['content']) {
                return $this->commentsRepository->update($comment, [
                    'content' => $data['content'],
                ]);
            } else {
                return $comment;
            }
        } else {
            return $this->commentsRepository->create([
                'card_id' => $data['card_id'],
                'media_id' => $data['media_card_id'],
                'media_comment_id' => sprintf('%s_%s', $data['plurk_id'], $data['id']),
                'user_id' => $data['user_info']['id'],
                'user_name' => $data['user_info']['full_name'],
                'user_avatar' => $data['user_info']['avatar_big'],
                'content' => $data['content'],
                'created_at' => $data['posted'],
            ]);
        }
    }
}
