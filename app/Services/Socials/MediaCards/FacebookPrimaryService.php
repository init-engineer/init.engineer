<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Social\Cards;
use App\Services\BaseService;
use Vinkla\Facebook\Facades\Facebook;
use App\Repositories\Frontend\Social\MediaCardsRepository;

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
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * FacebookPrimaryService constructor.
     */
    public function __construct(MediaCardsRepository $mediaCardsRepository)
    {
        $this->facebook = Facebook::connection('primary');
        $this->mediaCardsRepository = $mediaCardsRepository;
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'facebook', 'primary'))
        {
            throw new GeneralException(__('exceptions.frontend.social.media.cards.repeated_error'));
        }
        else
        {
            $response = $this->facebook->post(
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

            $this->mediaCardsRepository->create([
                'card_id' => $cards->id,
                'model_id' => $cards->model_id,
                'social_type' => 'facebook',
                'social_connections' => 'primary',
                'social_card_id' => $response->getGraphUser()->getId(),
            ]);
        }
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
