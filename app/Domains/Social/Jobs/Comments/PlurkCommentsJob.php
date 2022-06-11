<?php

namespace App\Domains\Social\Jobs\Comments;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use App\Domains\Social\Services\CommentsService;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

/**
 * Class PlurkCommentsJob.
 */
class PlurkCommentsJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var PlatformCards
     */
    protected $platformCards;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCards
     *
     * @return void
     */
    public function __construct(Platform $platform, PlatformCards $platformCards)
    {
        $this->platform = $platform;
        $this->platformCards = $platformCards;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
         */
        if (!isset($this->platform->config['consumer_app_key']) ||
            !isset($this->platform->config['consumer_app_secret']) ||
            !isset($this->platform->config['access_token']) ||
            !isset($this->platform->config['access_token_secret'])) {
            /**
             * Config 有問題，無法處理
             */
            activity('social cards - comments error')
                ->performedOn($this->platformCards)
                ->log(json_encode($this->platform));

            return;
        }

        /**
         * 透過 Guzzle 的 HandlerStack 來建立堆疊
         */
        $stack = HandlerStack::create();

        /**
         * 透過 Guzzle 的 OAuth1 來建立請求
         */
        $middleware = new Oauth1(array(
            'consumer_key'    => $this->platform->config['consumer_app_key'],
            'consumer_secret' => $this->platform->config['consumer_app_secret'],
            'token'           => $this->platform->config['access_token'],
            'token_secret'    => $this->platform->config['access_token_secret'],
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
         * 建構 CommentsService 物件
         */
        $container = Container::getInstance();
        $commentService = $container->make(CommentsService::class);

        /**
         * 換得整個 Comments 的資訊列
         */
        $plurkResponse = $client->get('/APP/Responses/get', [
            'plurk_id' => base_convert($this->platformCards->platform_string_id, 36, 10),
            'count' => 'all',
        ]);

        /**
         * 根據 Comments 的資訊列來逐一檢查是否新增或更新的資料
         */
        if ($plurkResponse->status() !== 200) {
            /**
             * Plurk Not Found.
             *
             * 找不到此則噗浪訊息。
             * 有可能原作者已經刪除此訊息或回應了。
             */

            return;
        }

        foreach ($plurkResponse->json()['responses'] as $response) {
            /**
             * 判斷 Comment 是否已經存在
             */
            $platform_string_id = sprintf('%s_%s', $response['plurk_id'], $response['id']);
            $profile = $client->get('/APP/Profile/getPublicProfile', [
                'user_id' => $response['user_id'],
            ]);
            if ($commentModel = $commentService->findCommentById($platform_string_id)) {
                /**
                 * 判斷內容是否需要更新。
                 */
                if ($commentModel->content != $response['content']) {
                    $commentModel->content = $response['content'];
                    $commentModel->save();
                }

                /**
                 * 判斷有沒有正確獲得使用者資訊
                 */
                if ($profile->successful()) {
                    /**
                     * 判斷使用者資訊是否需要更新。
                     */
                    if ($commentModel->user_id != $profile->json()['user_info']['id'] ||
                        $commentModel->user_name != $profile->json()['user_info']['full_name'] ||
                        $commentModel->user_avatar != $profile->json()['user_info']['avatar_big']) {
                        $commentModel->user_id = $profile->json()['user_info']['id'];
                        $commentModel->user_name = $profile->json()['user_info']['full_name'];
                        $commentModel->user_avatar = $profile->json()['user_info']['avatar_big'];
                        $commentModel->save();
                    }
                }
            } else {
                /**
                 * Comment 並不存在，直接寫入一筆新的資料。
                 */
                $commentService->store(array(
                    'card_id' => $this->platformCards->card_id,
                    'platform_id' => $this->platform->id,
                    'platform_card_id' => $this->platformCards->id,
                    'comment_id' => $platform_string_id,
                    'user_id' => $profile->json()['user_info']['id'],
                    'user_name' => $profile->json()['user_info']['full_name'],
                    'user_avatar' => $profile->json()['user_info']['avatar_big'],
                    'content' => $response['content'],
                    'created_at' => $response['posted'],
                ));
            }
        }
    }
}
