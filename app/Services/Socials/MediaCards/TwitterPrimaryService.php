<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Exceptions\GeneralException;
use ReliqArts\Thujohn\Twitter\Facades\Twitter;
use App\Repositories\Frontend\Social\MediaCardsRepository;

/**
 * Class TwitterPrimaryService.
 */
class TwitterPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * TwitterPrimaryService constructor.
     */
    public function __construct(MediaCardsRepository $mediaCardsRepository)
    {
        $this->mediaCardsRepository = $mediaCardsRepository;
    }

    /**
     * @param Cards $cards
     * @return MediaCards
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'twitter', 'primary'))
        {
            throw new GeneralException(__('exceptions.backend.social.media.cards.repeated_error'));
        }
        else
        {
            $picture = Twitter::uploadMedia([
                'media' => $cards->images->first()->getFile(),
            ]);
            $response = Twitter::postTweet([
                'status' => $this->buildContent($cards->content, [
                    'id' => $cards->id,
                ]),
                'media_ids' => $picture->media_id_string
            ]);

            return $this->mediaCardsRepository->create([
                'card_id' => $cards->id,
                'model_id' => $cards->model_id,
                'social_type' => 'twitter',
                'social_connections' => 'primary',
                'social_card_id' => $response->id,
            ]);
        }
    }

    /**
     * 注意: Twitter 的內容如果超過英文 280 字或是中文 140 字的話，多餘的內容將會被 Twitter 自動忽略。
     *
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        $_content = (mb_strlen($content, 'utf-8') > 48)? mb_substr($content, 0, 48, 'utf-8') . ' ...' : $content;

        return sprintf(
            "#%s%s\r\n%s\r\n📢 匿名發文請至 %s\r\n🥙 全平台留言 %s",
            app_name(),
            base_convert($options['id'], 10, 36),
            $_content,
            route('frontend.social.cards.create'),
            route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
