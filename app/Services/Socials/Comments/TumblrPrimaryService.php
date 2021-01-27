<?php

namespace App\Services\Socials\Comments;

use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Social\CommentsRepository;
use App\Repositories\Backend\Social\MediaCardsRepository;
use Tumblr\API\Client as TumblrClient;
use Carbon\Carbon;

/**
 * Class TumblrPrimaryService.
 */
class TumblrPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var Twitter
     */
    // protected $twitter;

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

        $this->tumblr = new TumblrClient(config('tumblr.CONSUMER_KEY'), config('tumblr.CONSUMER_SECRET'));
        $this->tumblr->setToken(config('tumblr.ACCESS_TOKEN'), config('tumblr.ACCESS_TOKEN_SECRET'));

    }

    /**
     * @param Cards $cards
     * @return
     */
    public function getComments(Cards $cards)
    {
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'tumblr', 'primary'))
        {
            try
            {
                $params = [
                    'id' => $mediaCards->social_card_id,
                    'mode' => 'all'
                ];

                $url = sprintf('v2/blog/%s/notes', config('social.tumblr.primary.user_id'));

                $response = $this->tumblr->getRequest($url, $params, null);

                $replies = collect($response->notes)->where('type', 'reply');

                foreach ($replies as $reply)
                {
                    $profile = $this->tumblr->getBlogInfo($reply->blog_name);
                    $reply = array_merge((array)$reply, (array)$profile);
                    $this->write(array_merge($reply, [
                        'card_id' => $cards->id,
                        'media_card_id' => $mediaCards->id,
                        'media_comment_id' => sprintf('%s_%s', $reply['blog_name'], $reply['timestamp']),
                    ]));
                }
            }
            catch (Exception $e)
            {
                \Log::error($e->getMessage());
            }
        }
    }

    /**
     * @param array $data
     */
    private function write(array $data)
    {
        if ($comment = $this->commentsRepository->findBySocialId($data['card_id'], $data['media_card_id'], $data['media_comment_id']))
        {
            if ($comment->content != $data['reply_text'])
            {
                return $this->commentsRepository->update($comment, [
                    'content' => $data['reply_text'],
                ]);
            }
            else
            {
                return $comment;
            }
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $data['card_id'],
                'media_id' => $data['media_card_id'],
                'media_comment_id' => sprintf('%s_%s', $data['blog_name'], $data['timestamp']),
                'user_id' => $data['blog']->uuid,
                'user_name' => $data['blog']->name,
                'user_avatar' => $data['blog']->avatar[0]->url,
                'content' => $data['reply_text'],
                'created_at' => Carbon::createFromTimestamp($data['timestamp'])->toDateTimeString(),
            ]);
        }
    }
}
