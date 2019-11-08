<?php

namespace App\Services\Socials\MediaCards;

use App\Models\Social\Cards;
use App\Services\BaseService;
use ReliqArts\Thujohn\Twitter\Facades\Twitter;

/**
 * Class TwitterPrimaryService.
 */
class TwitterPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     * TwitterPrimaryService constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Cards $cards
     * @return
     */
    public function publish(Cards $cards)
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
            "#純靠北工程師%s\r\n%s\r\n📢 匿名發文請至 %s\r\n🥙 全平台留言 %s",
            base_convert($options['id'], 10, 36),
            $_content,
            route('frontend.social.cards.create'),
            '#', // route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
