<?php

namespace App\Domains\Social\Services\Platform;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use App\Domains\Social\Services\CardsService;
use App\Domains\Social\Services\Content\ContentFluent;
use Carbon\Carbon;
use Illuminate\Container\Container;
use Thujohn\Twitter\Facades\Twitter;

/**
 * Class TwitterProvider.
 */
class TwitterProvider extends AbstractProvider
{
    /**
     * TwitterProvider constructor.
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

            $cardsService = Container::getInstance()->make(CardsService::class);
            return $cardsService->registerPlatform($cards, array(
                'platform' => array(
                    'id' => $this->platform->id,
                    'name' => $this->platform->name,
                    'type' => $this->platform->type,
                ),
                'post_id' => $response->id,
                'created_at' => Carbon::now(),
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
