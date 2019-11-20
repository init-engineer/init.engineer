<?php

namespace App\Services\Socials\MediaCards;

use Facebook\FacebookApp;
use App\Models\Social\Cards;
use App\Services\BaseService;
use Facebook\FacebookRequest;
use App\Exceptions\GeneralException;
use Vinkla\Facebook\Facades\Facebook;
use App\Repositories\Frontend\Social\MediaCardsRepository;

/**
 * Class FacebookPrimaryService.
 */
class FacebookPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * FacebookPrimaryService constructor.
     */
    public function __construct(MediaCardsRepository $mediaCardsRepository)
    {
        $this->facebook = Facebook::connection('primary');
        $this->mediaCardsRepository = $mediaCardsRepository;
        $this->getAccessToken();
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'facebook', 'primary'))
        {
            throw new GeneralException(__('exceptions.backend.social.media.cards.repeated_error'));
        }
        else
        {
            $response = $this->facebook->post(
                sprintf(
                    '/%s/photos',
                    config('facebook.connections.primary.user_id')
                ),
                [
                    'message' => $this->buildContent($cards->content, [
                        'id' => $cards->id,
                    ]),
                    'source' => $this->facebook->fileToUpload($cards->images->first()->getPicture()),
                ],
            );

            $this->mediaCardsRepository->create([
                'card_id' => $cards->id,
                'model_id' => $cards->model_id,
                'social_type' => 'facebook',
                'social_connections' => 'primary',
                'social_card_id' => $response->getGraphUser()->getId(),
            ]);
        }
    }

    /**
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        return sprintf(
            "#%s%s\r\n%s\r\n📢 匿名發文請至 %s\r\n🥙 全平台留言 %s",
            app_name(),
            base_convert($options['id'], 10, 36),
            $content,
            route('frontend.social.cards.create'),
            route('frontend.social.cards.show', ['id' => $options['id']])
        );
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
            config('facebook.connections.primary.user_id'),
            ['fields' => 'access_token']
        );

        $accessToken = $this->facebook->getClient()->sendRequest($facebookRequest)->getDecodedBody();
        $foreverPageAccessToken = $accessToken['access_token'];
        $this->facebook->setDefaultAccessToken($foreverPageAccessToken);
    }
}
