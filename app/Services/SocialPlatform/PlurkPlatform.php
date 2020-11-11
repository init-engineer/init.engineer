<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;
use App\Models\Social\Platform;
use App\Repositories\Backend\Social\CardPostRepository;
use App\Services\SocialContent\ContentFluent;
use Qlurk\ApiClient;

/**
 * Class PlurkPlatform.
 */
class PlurkPlatform extends BasePlatform
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var ApiClient
     */
    protected $plurk;

    /**
     * @var CardPostRepository
     */
    protected $cardPostRepository;

    /**
     * PlurkPlatform constructor.
     *
     * @param Platform $platform
     * @param CardPostRepository $cardPostRepository
     */
    public function __construct(Platform $platform, CardPostRepository $cardPostRepository)
    {
        $this->platform = $platform;
        $this->config = json_decode($this->platform->config, true);
        $this->plurk = new ApiClient(
            $this->config['client_id'],
            $this->config['client_secret'],
            $this->config['token'],
            $this->config['token_secret'],
        );
        $this->cardPostRepository = $cardPostRepository;
    }

    /**
     * @param Cards $cards
     * @param ContentFluent $contentFluent
     *
     * @throws Exception
     * @return CardPost
     */
    public function publish(Cards $cards, ContentFluent $contentFluent)
    {
        try {
            $picture = $this->plurk->call('/APP/Timeline/uploadPicture', array(
                'image' => $cards->images->first()->getFile(),
            ));

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
