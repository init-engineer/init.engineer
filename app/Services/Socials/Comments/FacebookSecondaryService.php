<?php

namespace App\Services\Socials\Comments;

use Facebook\FacebookApp;
use App\Models\Social\Cards;
use App\Services\BaseService;
use Facebook\FacebookRequest;
use App\Exceptions\GeneralException;
use Vinkla\Facebook\Facades\Facebook;
use App\Repositories\Backend\Social\CommentsRepository;
use App\Repositories\Backend\Social\MediaCardsRepository;

/**
 * Class FacebookSecondaryService.
 */
class FacebookSecondaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepository;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * FacebookSecondaryService constructor.
     */
    public function __construct(CommentsRepository $commentsRepository, MediaCardsRepository $mediaCardsRepository)
    {
        $this->commentsRepository = $commentsRepository;
        $this->mediaCardsRepository = $mediaCardsRepository;
        $this->facebook = Facebook::connection('secondary');
    }

    /**
     * @param Cards $cards
     * @return void
     */
    public function getComments(Cards $cards)
    {
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'facebook', 'secondary'))
        {
            try
            {
                $this->getAccessToken();
                $url = sprintf(
                    '/%s/comments?fields=id,message,from,created_time,comments{id,message,from,created_time}',
                    $mediaCards->social_card_id
                );
                $replys = $this->facebook->get($url)->getDecodedBody();

                foreach ($replys['data'] as $reply)
                {
                    $comment = $this->write(array_merge($reply, [
                        'card_id' => $cards->id,
                        'media_card_id' => $mediaCards->id,
                        'media_comment_id' => $reply['id'],
                    ]));

                    if (isset($reply['comments']['data']))
                    {
                        foreach ($reply['comments']['data'] as $commentReply)
                        {
                            $this->write(array_merge($commentReply, [
                                'card_id' => $cards->id,
                                'media_card_id' => $mediaCards->id,
                                'media_comment_id' => $commentReply['id'],
                                'reply_id' => $comment->media_comment_id,
                                'created_time' => $commentReply['created_time'],
                            ]));
                        }
                    }
                }
            }
            catch (\Facebook\Exceptions\FacebookSDKException $e)
            {
                dd($e->getMessage());
            }
            catch (Exception $e)
            {
                dd($e->getMessage());
            }
        }
    }

    /**
     * @param array $data
     * @return Comments
     */
    private function write(array $data)
    {
        if ($comment = $this->commentsRepository->findBySocialId($data['card_id'], $data['media_card_id'], $data['media_comment_id']))
        {
            if ($comment->content != $data['message'])
            {
                return $this->commentsRepository->update($comment, [
                    'content' => $data['message'],
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
                'media_comment_id' => $data['media_comment_id'],
                'user_id' => $data['from']['id'],
                'user_name' => $data['from']['name'],
                'user_avatar' => sprintf('https://graph.facebook.com/%s/picture?type=large', $data['from']['id']),
                'content' => $data['message'] ?? $data['content'] ?? null,
                'reply_media_comment_id' => isset($data['reply_id'])? $data['reply_id'] : null,
                'created_at' => $data['created_time'],
            ]);
        }
    }

    /**
     * --------------------------------------------------------------------------------
     * ## 問題描述
     * --------------------------------------------------------------------------------
     * Facebook 發表文章的流程因 Facebook 所頒布的新政策關係，導致無法正常發表文章。
     *
     * 圖形 API 3.0 版已停用 publish_actions 權限。
     * 應用程式仍可透過中介式體驗（例如網路上的 Facebook「分享」對話方塊）或 iOS 和 Android 的「Share Sheets」發佈動態。
     * 應用程式可利用 publish_groups 權限發佈到群組，但應用程式必須通過審查才能取得該權限。
     *
     * 會發生這種情況的原因，是因為 Access Token 使用的是 Pages Token(粉絲專頁的 Token)，今後 Facebook 將禁用這方面的權限。
     *
     * --------------------------------------------------------------------------------
     * ## 解決方案
     * --------------------------------------------------------------------------------
     * 透過使用者的 Token 來抓取 Access Token，然後動態去抓 Pages Token 來發表文章。
     * 這個動作必須每次發文時都要執行一次，因為產生出來的 Pages Token 時效性很短，可能不到一小時。
     *
     * https://github.com/init-engineer/init.engineer/issues/2
     */
    private function getAccessToken()
    {
        $facebookApp = new FacebookApp(
            $this->facebook->getApp()->getId(),
            $this->facebook->getApp()->getSecret()
        );

        $facebookRequest = new FacebookRequest(
            $facebookApp,
            $this->facebook->getDefaultAccessToken()->getValue(),
            'GET',
            config('facebook.connections.secondary.user_id', 'FACEBOOK_CONNECTIONS_SECONDARY_USER_ID'),
            ['fields' => 'access_token']
        );

        $accessToken = $this->facebook->getClient()->sendRequest($facebookRequest)->getDecodedBody();
        $foreverPageAccessToken = $accessToken['access_token'];
        $this->facebook->setDefaultAccessToken($foreverPageAccessToken);
    }
}
