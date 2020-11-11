<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;
use App\Models\Social\Platform;
use App\Repositories\Backend\Social\CardPostRepository;
use App\Services\SocialContent\ContentFluent;
use ReliqArts\Thujohn\Twitter\Facades\Twitter;

/**
 * Class TwitterPlatform.
 */
class TwitterPlatform extends BasePlatform
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
     * @var CardPostRepository
     */
    protected $cardPostRepository;

    /**
     * TwitterPlatform constructor.
     *
     * @param Platform $platform
     * @param CardPostRepository $cardPostRepository
     */
    public function __construct(Platform $platform, CardPostRepository $cardPostRepository)
    {
        $this->platform = $platform;
        $this->config = json_decode($this->platform->config, true);
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
            $picture = Twitter::uploadMedia([
                'media' => $cards->images->first()->getFile(),
            ]);
            $message = $contentFluent
                ->header($cards->id)
                ->body($cards->content, 20)
                ->footer(array(
                    'review' => true,
                    'github' => true,
                    'publish' => true,
                    'show' => true,
                ))
                ->get();
            $response = Twitter::postTweet(array(
                'status' => $message,
                'media_ids' => $picture->media_id_string,
            ));

            return $this->mediaCardsRepository->create(array(
                'card_id' => $cards->id,
                'model_id' => $cards->model_id,
                'social_type' => 'twitter',
                'social_connections' => 'primary',
                'social_card_id' => $response->id,
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
            Twitter::destroyTweet($post->social_card_id);

            // TODO: 解析 decodedBody 的資訊
            // $decodedBody = Twitter::destroyTweet($post->social_card_id);

            return $this->cardPostRepository->mark($post, false);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
