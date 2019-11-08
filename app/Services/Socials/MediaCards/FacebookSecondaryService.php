<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Social\Cards;
use App\Services\BaseService;
use Vinkla\Facebook\Facades\Facebook;

/**
 * Class FacebookSecondaryService.
 */
class FacebookSecondaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * FacebookSecondaryService constructor.
     */
    public function __construct()
    {
        $this->facebook = Facebook::connection('secondary');
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
    {
        $response = $this->facebook->post(
            sprintf(
                '/%s/photos',
                config('facebook.connections.secondary.user_id')
            ),
            array(
                'message' => $this->buildContent($cards->content, [
                    'id' => $cards->id,
                ]),
                'source' => $this->facebook->fileToUpload($cards->images->first()->getPicture()),
            ),
        );
    }

    /**
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        return sprintf(
            "#純靠北工程師%s\r\n%s\r\n📢 匿名發文請至 %s\r\n🥙 全平台留言 %s",
            base_convert($options['id'], 10, 36),
            $content,
            route('frontend.social.cards.create'),
            '#', // route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
