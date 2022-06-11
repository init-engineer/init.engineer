<?php

namespace App\Domains\Social\Jobs\Push;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

/**
 * Class PlurkPushCommentJob.
 */
class PlurkPushCommentJob implements ShouldQueue
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
    protected $platformCard;

    /**
     * @var string
     */
    protected $content;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCard
     * @param string $content
     *
     * @return void
     */
    public function __construct(Platform $platform, PlatformCards $platformCard, string $content)
    {
        $this->platform = $platform;
        $this->platformCard = $platformCard;
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * 發表到 Facebook
     * 文章內提及連結會影響觸及率，因此需要留言補充連結宣傳。
     *
     * @return void
     */
    public function handle()
    {
        /**
         * 判斷 Blog Name、Consumer Key、Consumer Secret、Token、Token Secret 是否為空
         */
        if (
            !isset($this->platform->config['consumer_app_key']) ||
            !isset($this->platform->config['consumer_app_secret']) ||
            !isset($this->platform->config['access_token']) ||
            !isset($this->platform->config['access_token_secret'])
        ) {
            /**
             * Config 有問題，無法處理
             */
            activity('social cards - plurk push content error')
                ->performedOn($this->platformCard)
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
        $middleware = new Oauth1([
            'consumer_key'    => $this->platform->config['consumer_app_key'],
            'consumer_secret' => $this->platform->config['consumer_app_secret'],
            'token'           => $this->platform->config['access_token'],
            'token_secret'    => $this->platform->config['access_token_secret'],
        ]);
        $stack->push($middleware);

        /**
         * 開始執行呼叫
         */
        $client = Http::withMiddleware($middleware)
            ->withOptions([
                'base_uri' => 'https://www.plurk.com',
                'handler' => $stack,
                'auth' => 'oauth',
            ]);

        /**
         * 對社群文章執行 Discord 宣傳留言
         */
        $response = $client->post('/APP/Responses/responseAdd', [
            'plurk_id' => $this->platformCard->platform_string_id,
            'content' => $this->content,
            'qualifier' => 'says',
            'lang' => 'tr_ch',
        ]);

        /**
         * 紀錄 Discord 宣傳留言
         */
        activity('social cards - plurk push content')
            ->performedOn($this->platformCard)
            ->log($response->body());

        return;
    }
}
