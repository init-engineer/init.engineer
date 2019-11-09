<?php

namespace App\Services\Socials\MediaCards;

use Qlurk\ApiClient;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Repositories\Frontend\Social\MediaCardsRepository;

/**
 * Class PlurkPrimaryService.
 */
class PlurkPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * @var ApiClient
     */
    protected $plurk;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * PlurkPrimaryService constructor.
     */
    public function __construct(MediaCardsRepository $mediaCardsRepository)
    {
        $this->plurk = new ApiClient(
            env('PLURK_CLIENT_ID'),
            env('PLURK_CLIENT_SECRET'),
            env('PLURK_TOKEN'),
            env('PLURK_TOKEN_SECRET')
        );
        $this->mediaCardsRepository = $mediaCardsRepository;
    }

    /**
     * 注意: Plurk 的內容如果超過中英文 360 字的話，多餘的內容將會被 Plurk 自動忽略。
     *
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'plurk', 'primary'))
        {
            throw new GeneralException(__('exceptions.frontend.social.media.cards.repeated_error'));
        }
        else
        {
            $picture = $this->plurk->call('/APP/Timeline/uploadPicture', [
                'image' => $cards->images->first()->getFile(),
            ]);
            $response = $this->plurk->call('/APP/Timeline/plurkAdd', [
                'content'   => $this->buildContent($cards->content, [
                    'id' => $cards->id,
                    'image_url' => $picture['full'],
                ]),
                'qualifier' => 'says',
                'lang'      => 'tr_ch'
            ]);

            $this->mediaCardsRepository->create([
                'card_id' => $cards->id,
                'model_id' => $cards->model_id,
                'social_type' => 'twitter',
                'social_connections' => 'primary',
                'social_card_id' => base_convert($response['plurk_id'], 10, 36),
            ]);
        }
    }

    /**
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        $_content = (mb_strlen($content, 'utf-8') > 220)? mb_substr($content, 0, 220, 'utf-8') . ' ...' : $content;

        return sprintf(
            "%s\r\n#純靠北工程師%s\r\n%s\r\n🥙 全平台留言 %s",
            $options['image_url'],
            base_convert($options['id'], 10, 36),
            $_content,
            '#', // route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
