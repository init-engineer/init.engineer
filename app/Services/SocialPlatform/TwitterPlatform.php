<?php

namespace App\Services\SocialPlatform;

use App\Models\Social\Cards;
use App\Models\Social\Platform;
use App\Services\SocialContent\ContentFluent;
use Illuminate\Container\Container;
use ReliqArts\Thujohn\Twitter\Facades\Twitter;

/**
 * Class TwitterPlatform.
 */
class TwitterPlatform extends BasePlatform
{
    /**
     * TwitterPlatform constructor.
     *
     * @param Platform $platform
     */
    public function __construct(Platform $platform)
    {
        parent::__construct($platform);
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
            $picture = Twitter::uploadMedia([
                'media' => $cards->images->first()->getFile(),
            ]);
            $contentFluent = Container::getInstance()->make(ContentFluent::class);
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
