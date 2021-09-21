<?php

namespace App\Domains\Social\Listeners;

use App\Domains\Social\Events\Cards\ArticleCreated;
use App\Domains\Social\Events\Cards\PictureCreated;
use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\Content\ContentFluent;
use App\Domains\Social\Services\PlatformCardService;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class CardsEventListener.
 */
class CardsEventListener
{
    /**
     * @param $event
     */
    public function onArticleCreated($event)
    {
        $this->notification(array(
            'type' => 'article',
            'id' => $event->cards->id,
            'picture' => $event->cards->getPicture(),
            'content' => $event->cards->content,
            'created_at' => $event->cards->created_at,
        ));
    }

    /**
     * @param $event
     */
    public function onPictureCreated($event)
    {
        $this->notification(array(
            'type' => 'picture',
            'id' => $event->cards->id,
            'picture' => $event->cards->getPicture(),
            'content' => $event->cards->content,
            'created_at' => $event->cards->created_at,
        ));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ArticleCreated::class,
            'App\Domains\Social\Listeners\CardsEventListener@onArticleCreated'
        );

        $events->listen(
            PictureCreated::class,
            'App\Domains\Social\Listeners\CardsEventListener@onPictureCreated'
        );
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function notification(array $data): void
    {
        /**
         * 先把需要通知的社群平台抓出來
         */
        $platforms = Platform::where('action', Platform::ACTION_NOTIFICATION)
            ->active()
            ->get();

        /**
         * 建立 Content 內容編排器
         */
        $container = Container::getInstance();
        $contentFluent = $container->make(ContentFluent::class);
        $platformCardService = $container->make(PlatformCardService::class);

        /**
         * 根據社群平台逐一通知
         */
        foreach ($platforms as $platform) {
            switch ($platform->type) {
                /**
                 * 發表到 Facebook
                 * 文章內提及連結會影響觸及率，因此需要留言補充連結宣傳。
                 */
                case Platform::TYPE_FACEBOOK:
                    /**
                     * 判斷 Page ID、Access Token 是否為空
                     */
                    if (!isset($platform->config['user_id']) ||
                        !isset($platform->config['access_token'])) {
                        break;
                    }

                    /**
                     * 整理文章通知的內容
                     */
                    $message = $contentFluent->header($data['id'])
                        ->hr()
                        ->body($data['content'])
                        ->build();

                    /**
                     * 開始執行通知
                     */
                    $userID = $platform->config['user_id'];
                    $url = "https://graph.facebook.com/$userID/photos?";
                    $response = Http::post($url, array(
                        'url' => $data['picture'],
                        'access_token' => $platform->config['access_token'],
                        'message' => $message,
                    ));

                    /**
                     * 紀錄 response 資訊
                     */
                    activity('social cards - facebook notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());

                    /**
                     * 建立 PlatformCards 紀錄
                     */
                    $platformCard = $platformCardService->store(array(
                        'platform_type' => Platform::TYPE_FACEBOOK,
                        'platform_id' => $platform->id,
                        'platform_string_id' => $response->body()['post_id'],
                        'card_id' => $data['id'],
                    ));

                    /**
                     * 紀錄 PlatformCards 紀錄
                     */
                    activity('social cards - facebook platform card')
                        ->performedOn(Platform::find($platformCard->id))
                        ->log(json_encode($platformCard));
                    break;

                /**
                 * 發表到 Twitter
                 * 字數限制 280 字元，因此需要留言補充連結宣傳。
                 */
                case Platform::TYPE_TWITTER:
                    /**
                     * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
                     */
                    if (!isset($platform->config['consumer_app_key']) ||
                        !isset($platform->config['consumer_app_secret']) ||
                        !isset($platform->config['access_token']) ||
                        !isset($platform->config['access_token_secret'])) {
                        break;
                    }

                    /**
                     * 透過 Guzzle 的 HandlerStack 來建立堆疊
                     */
                    $stack = HandlerStack::create();

                    /**
                     * 透過 Guzzle 的 OAuth1 來建立請求
                     */
                    $middleware = new Oauth1(array(
                        'consumer_key'    => $platform->config['consumer_app_key'],
                        'consumer_secret' => $platform->config['consumer_app_secret'],
                        'token'           => $platform->config['access_token'],
                        'token_secret'    => $platform->config['access_token_secret'],
                    ));
                    $stack->push($middleware);

                    /**
                     * 開始執行通知
                     */
                    $client = Http::withMiddleware($middleware)
                        ->withOptions(array(
                            'handler' => $stack,
                            'auth' => 'oauth',
                        ));

                    /**
                     * 先判斷媒體是圖片(jpg、jpeg、png)還是動畫(gif)
                     */
                    $tweetType = explode('.', $data['picture']);
                    $tweetType = array_pop($tweetType);
                    $tweetType = ($tweetType === 'gif') ? 'tweet_gif' : 'tweet_image';

                    /**
                     * 先將圖片透過 multipart/form-data 的方式上傳到 Twitter
                     */
                    $pictureArray = explode('/', $data['picture']);
                    $pictureResponse = $client->asMultipart()->post('https://upload.twitter.com/1.1/media/upload.json?media_category=' . $tweetType, array(
                        array(
                            'name' => 'media',
                            'contents' => Storage::get(str_replace('storage', 'public', $data['picture'])),
                            'filename' => array_pop($pictureArray),
                        ),
                    ));

                    /**
                     * 紀錄 picture response 資訊
                     */
                    activity('social cards - twitter notification - picture')
                        ->performedOn(Cards::find($data['id']))
                        ->log($pictureResponse->body());

                    /**
                     * 整理文章通知的內容
                     */
                    $status = $contentFluent->header($data['id'])
                        ->hr()
                        ->body(Str::limit($data['content'], 64, ' ...'))
                        ->build();

                    /**
                     * 將圖片拼到推文當中發表出去
                     */
                    $tweetResponse = $client->asForm()->post('https://api.twitter.com/1.1/statuses/update.json', array(
                        'status' => $status,
                        'media_ids' => $pictureResponse['media_id_string'],
                    ));

                    /**
                     * 紀錄 picture response 資訊
                     */
                    activity('social cards - twitter notification - tweet')
                        ->performedOn(Cards::find($data['id']))
                        ->log($tweetResponse->body());
                    break;

                /**
                 * 發表到 Plurk
                 * 字數限制 360 字元，因此需要留言補充連結宣傳。
                 */
                case Platform::TYPE_PLURK:
                    /**
                     * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
                     */
                    if (!isset($platform->config['consumer_app_key']) ||
                        !isset($platform->config['consumer_app_secret']) ||
                        !isset($platform->config['access_token']) ||
                        !isset($platform->config['access_token_secret'])) {
                        break;
                    }

                    /**
                     * 透過 Guzzle 的 HandlerStack 來建立堆疊
                     */
                    $stack = HandlerStack::create();

                    /**
                     * 透過 Guzzle 的 OAuth1 來建立請求
                     */
                    $middleware = new Oauth1(array(
                        'consumer_key'    => $platform->config['consumer_app_key'],
                        'consumer_secret' => $platform->config['consumer_app_secret'],
                        'token'           => $platform->config['access_token'],
                        'token_secret'    => $platform->config['access_token_secret'],
                    ));
                    $stack->push($middleware);

                    /**
                     * 開始執行通知
                     */
                    $client = Http::withMiddleware($middleware)
                        ->withOptions(array(
                            'base_uri' => 'https://www.plurk.com',
                            'handler' => $stack,
                            'auth' => 'oauth',
                        ));

                    /**
                     * 先將圖片透過 multipart/form-data 的方式上傳到 Plurk
                     */
                    $pictureArray = explode('/', $data['picture']);
                    $pictureResponse = $client->asMultipart()->post('/APP/Timeline/uploadPicture', array(
                        array(
                            'name' => 'image',
                            'contents' => Storage::get(str_replace('storage', 'public', $data['picture'])),
                            'filename' => array_pop($pictureArray),
                        ),
                    ));

                    /**
                     * 紀錄 picture response 資訊
                     */
                    activity('social cards - plurk notification - picture')
                        ->performedOn(Cards::find($data['id']))
                        ->log($pictureResponse->body());

                    /**
                     * 整理文章通知的內容
                     */
                    $content = $contentFluent->image($pictureResponse['full'])
                        ->header($data['id'])
                        ->hr()
                        ->body(Str::limit($data['content'], 192, ' ...'))
                        ->build();

                    /**
                     * 將圖片拼到噗文當中發表出去
                     */
                    $plurkResponse = $client->post('/APP/Timeline/plurkAdd', array(
                        'content' => $content,
                        'qualifier' => 'says',
                        'lang' => 'tr_ch',
                    ));

                    /**
                     * 紀錄 plurk response 資訊
                     */
                    activity('social cards - plurk notification - plurk')
                        ->performedOn(Cards::find($data['id']))
                        ->log($plurkResponse->body());
                    break;

                /**
                 * 發表到 Discord
                 * 字數限制 2,000，所以不需要留言補充連結宣傳，只需要對內文下 Limit 即可。
                 */
                case Platform::TYPE_DISCORD:
                    /**
                     * 判斷 Webhook URL 是否為空
                     */
                    if (!isset($platform->config['webhook'])) {
                        break;
                    }

                    /**
                     * 開始執行通知
                     */
                    $url = $platform->config['webhook'];
                    $response = Http::post($url, array(
                        'embeds' => array(
                            array(
                                'title' => '#' . appName() . base_convert($data['id'], 10, 36),
                                'url' => route('frontend.social.cards.show', $data['id']),
                                'description' => Str::limit($data['content'], 1800, ' ...'),
                                'color' => 15258703,
                                'image' => array(
                                    'url' => $data['picture'],
                                ),
                                'timestamp' => $data['created_at'],
                            ),
                        ),
                    ));

                    /**
                     * 紀錄 response 資訊
                     */
                    activity('social cards - discord notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());
                    break;

                /**
                 * 發表到 Tumblr
                 * 因為沒有字數限制，所以不需要留言補充連結宣傳。
                 */
                case Platform::TYPE_TUMBLR:
                    /**
                     * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
                     */
                    if (!isset($platform->config['user_id']) ||
                        !isset($platform->config['consumer_app_key']) ||
                        !isset($platform->config['consumer_app_secret']) ||
                        !isset($platform->config['access_token']) ||
                        !isset($platform->config['access_token_secret'])) {
                        break;
                    }

                    /**
                     * 透過 Guzzle 的 HandlerStack 來建立堆疊
                     */
                    $stack = HandlerStack::create();

                    /**
                     * 透過 Guzzle 的 OAuth1 來建立請求
                     */
                    $middleware = new Oauth1(array(
                        'consumer_key'    => $platform->config['consumer_app_key'],
                        'consumer_secret' => $platform->config['consumer_app_secret'],
                        'token'           => $platform->config['access_token'],
                        'token_secret'    => $platform->config['access_token_secret'],
                    ));
                    $stack->push($middleware);

                    /**
                     * 整理文章通知的內容
                     */
                    $caption = $contentFluent->header($data['id'])
                        ->hr()
                        ->body($data['content'])
                        ->hr()
                        ->footer(sprintf('💖 %s 官方 Discord 歡迎在這找到你的同溫層！', appName()))
                        ->footer('👉 https://discord.gg/tPhnrs2')
                        ->hr()
                        ->footer('💖 全平台留言、文章詳細內容')
                        ->footer('👉 ' . route('frontend.social.cards.show', ['id' => $data['id']]))
                        ->build('html');

                    /**
                     * 整理 API Uri
                     */
                    $name = $platform->config['user_id'];
                    $url = "/v2/blog/$name.tumblr.com/post";

                    /**
                     * 開始執行通知
                     */
                    $response = Http::withMiddleware($middleware)
                        ->withOptions(array(
                            'base_uri' => 'https://api.tumblr.com',
                            'handler' => $stack,
                            'auth' => 'oauth',
                        ))->post($url, array(
                            'source' => $data['picture'],
                            'type' => 'photo',
                            'caption' => $caption,
                        ));

                    /**
                     * 紀錄 response 資訊
                     */
                    activity('social cards - tumblr notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());
                    break;

                /**
                 * 發表到 Telegram
                 * 因為沒有字數限制，所以不需要留言補充連結宣傳。
                 */
                case Platform::TYPE_TELEGRAM:
                    /**
                     * 判斷 Access token 與 Chat ID 是否為空
                     */
                    if (!isset($platform->config['chat_id']) ||
                        !isset($platform->config['access_token'])) {
                        break;
                    }

                    /**
                     * 整理文章通知的內容
                     */
                    $caption = $contentFluent->header($data['id'])
                        ->hr()
                        ->body($data['content'])
                        ->hr()
                        ->footer(sprintf('💖 %s 官方 Discord 歡迎在這找到你的同溫層！', appName()))
                        ->footer('👉 https://discord.gg/tPhnrs2')
                        ->hr()
                        ->footer('💖 全平台留言、文章詳細內容')
                        ->footer('👉 ' . route('frontend.social.cards.show', ['id' => $data['id']]))
                        ->build();

                    /**
                     * 開始執行通知
                     */
                    $token = $platform->config['access_token'];
                    $url = "https://api.telegram.org/bot$token/sendPhoto";
                    $response = Http::post($url, array(
                        'chat_id' => $platform->config['chat_id'],
                        'photo' => $data['picture'],
                        'caption' => $caption,
                    ));

                    /**
                     * 紀錄 response 資訊
                     */
                    activity('social cards - telegram notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log($response->body());
                    break;

                /**
                 * 其它並不在支援名單當中的社群
                 */
                default:
                    /**
                     * 直接把資料寫入 Activity log 以便日後查核
                     */
                    activity('social cards - undefined notification')
                        ->performedOn(Cards::find($data['id']))
                        ->log(json_encode($data));
                    break;
            }
        }

        return;
    }
}
