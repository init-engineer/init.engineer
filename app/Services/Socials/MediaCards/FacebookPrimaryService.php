<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Social\Cards;
use App\Services\BaseService;
use Vinkla\Facebook\Facades\Facebook;

/**
 * Class FacebookPrimaryService.
 */
class FacebookPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var Facebook
     */
    protected $facebook;

    /**
     * FacebookPrimaryService constructor.
     */
    public function __construct()
    {
        $this->facebook = Facebook::connection('primary');
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
    {
        $facebook_primary_media_card = $this->facebook->post(
            sprintf(
                '/%s/photos',
                config('facebook.connections.primary.user_id')
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
            '#', // route('frontend.social.cards.create')
            '#', // route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
