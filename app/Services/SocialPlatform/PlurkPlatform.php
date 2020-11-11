<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;
use App\Models\Social\Platform;
use App\Services\SocialContent\ContentFluent;
use Illuminate\Container\Container;
use Qlurk\ApiClient;

/**
 * Class PlurkPlatform.
 */
class PlurkPlatform extends BasePlatform
{
    /**
     * @var ApiClient
     */
    protected $plurk;

    /**
     * PlurkPlatform constructor.
     *
     * @param Platform $platform
     */
    public function __construct(Platform $platform)
    {
        parent::__construct($platform);

        $this->plurk = new ApiClient(
            $this->config['client_id'],
            $this->config['client_secret'],
            $this->config['token'],
            $this->config['token_secret'],
        );
    }

    /**
     * @param Cards $cards
     *
     * @throws Exception
     * @return CardPost
     */
    public function publish(Cards $cards)
    {
        try {
            $picture = $this->plurk->call('/APP/Timeline/uploadPicture', array(
                'image' => $cards->images->first()->getFile(),
            ));
            $contentFluent = Container::getInstance()->make(ContentFluent::class);
            $message = $contentFluent
                ->header($cards->id)
                ->body($picture['full'] . "\n\r" . $cards->content, 100)
                ->footer(array(
                    'review' => true,
                    'github' => true,
                    'publish' => true,
                    'show' => true,
                ))
                ->get();
            $response = $this->plurk->call('/APP/Timeline/plurkAdd', array(
                'content' => $message,
                'qualifier' => 'says',
                'lang' => 'tr_ch',
            ));

            return $this->cardPostRepository->create(array(
                'card_id' => $cards->id,
                'platform_id' => $this->platform->id,
                'social_card_id' => base_convert($response['plurk_id'], 10, 36),
                'active' => true,
            ));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    /**
     * @param Cards $cards
     *
     * @throws Exception
     * @return CardPost
     */
    public function deleted(Cards $cards)
    {
        try {
            $post = $this->cardPostRepository->findByPlatformCard($this->platform, $cards);
            $this->plurk->call(
                '/APP/Timeline/plurkDelete',
                array('plurk_id' => base_convert($post->social_card_id, 36, 10))
            );

            // TODO: 解析 decodedBody 的資訊
            // $decodedBody = $this->plurk->call(
            //     '/APP/Timeline/plurkDelete',
            //     array('plurk_id' => base_convert($post->social_card_id, 36, 10))
            // );

            return $this->cardPostRepository->mark($post, false);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
