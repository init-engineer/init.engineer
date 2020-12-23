<?php

namespace App\Domains\Social\Services\Platform;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CardsService;
use Carbon\Carbon;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\FacebookRequest;
use Illuminate\Container\Container;

/**
 * Class FacebookProvider.
 */
class FacebookProvider extends AbstractProvider
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * FacebookProvider constructor.
     *
     * @param Platform $platform
     */
    public function __construct(Platform $platform)
    {
        parent::__construct($platform);

        $this->facebook = new Facebook(array(
            'app_id' => $this->config['app_id'],
            'app_secret' => $this->config['app_secret'],
            'default_graph_version' => $this->config['graph_version'],
            'default_access_token' => $this->config['access_token'],
        ));
    }

    /**
     * @param Cards $cards
     *
     * @throws FacebookSDKException
     * @throws Exception
     * @return Cards
     */
    public function publish(Cards $cards)
    {
        try {
            $contentFluent = Container::getInstance()->make(ContentFluent::class);
            $message = $contentFluent
                ->header($cards->id)
                ->body($cards->content)
                ->footer(array(
                    'review' => true,
                    'github' => true,
                    'publish' => true,
                    'show' => true,
                ))
                ->get();
            $this->getAccessToken();
            $response = $this->facebook->post('/' . $this->config['user_id'] . '/photos', array(
                'message' => $message,
                'source' => $this->facebook->fileToUpload($cards->getImage()),
            ));

            $cardsService = Container::getInstance()->make(CardsService::class);
            return $cardsService->registerPlatform($cards, array(
                'platform' => array(
                    'id' => $this->platform->id,
                    'name' => $this->platform->name,
                    'type' => $this->platform->type,
                ),
                'post_id' => $response->getGraphUser()->getId(),
                'created_at' => Carbon::now(),
            ));
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
        }
    }

    /**
     * @param Cards $cards
     *
     * @throws FacebookSDKException
     * @throws Exception
     * @return Cards
     */
    public function deleted(Cards $cards)
    {
        $post = $this->cardPostRepository->findByPlatformCard($this->platform, $cards);
        try {
            $this->getAccessToken();
            $this->facebook->delete('/' . $post->social_card_id);

            // TODO: 解析 decodedBody 的資訊
            // $response = $this->facebook->delete("/" . $post->social_card_id);
            // $decodedBody = $response->getDecodedBody();

            return $this->cardPostRepository->mark($post, false);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
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
     *
     * @return void
     */
    protected function getAccessToken(): void
    {
        try {
            $facebookApp = new FacebookApp(
                $this->facebook->getApp()->getId(),
                $this->facebook->getApp()->getSecret()
            );

            $facebookRequest = new FacebookRequest(
                $facebookApp,
                $this->facebook->getDefaultAccessToken()->getValue(),
                'GET',
                $this->config['user_id'],
                array('fields' => 'access_token')
            );

            $accessToken = $this->facebook->getClient()->sendRequest($facebookRequest)->getDecodedBody();
            $foreverPageAccessToken = $accessToken['access_token'];
            $this->facebook->setDefaultAccessToken($foreverPageAccessToken);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            \Log::error($e->getMessage());
            exit;
        }
    }
}
