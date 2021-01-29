<?php

namespace App\Services\Socials\MediaCards;

use Exception;
use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Exceptions\GeneralException;
use ReliqArts\Thujohn\Twitter\Facades\Twitter;
use App\Repositories\Backend\Social\MediaCardsRepository;
use Illuminate\Support\Str;

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
            try
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
            catch (Exception $e)
            {
                \Log::error($e->getMessage());
            }
        }
    }

    /**
     * @param Cards $cards
     * @return MediaCards
     */
    public function update(Cards $cards)
    {
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'twitter', 'primary'))
        {
            try
            {
                $response = Twitter::getTweet($mediaCards->social_card_id);
                return $this->mediaCardsRepository->update($mediaCards, [
                    'num_like' => $response->favorite_count,
                    'num_share' => $response->retweet_count,
                ]);
            }
            catch (Exception $e)
            {
                \Log::error($e->getMessage());
            }
        }

        return false;
    }

    /**
     * @param User  $user
     * @param Cards $cards
     * @param array $options
     * @return MediaCards
     */
    public function destory(User $user, Cards $cards, array $options)
    {
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'twitter', 'primary'))
        {
            try
            {
                $response = Twitter::destroyTweet($mediaCards->social_card_id);

                // TODO: 解析 response 的資訊

                return $this->mediaCardsRepository->update($mediaCards, [
                    'active' => false,
                    'is_banned' => true,
                    'banned_user_id' => $user->id,
                    'banned_remarks' => isset($options['remarks'])? $options['remarks'] : null,
                    'banned_at' => now(),
                ]);
            }
            catch (\Facebook\Exceptions\FacebookSDKException $e)
            {
                \Log::error($e->getMessage());
            }
            catch (Exception $e)
            {
                \Log::error($e->getMessage());
            }
        }

        return false;
    }

    /**
     * 注意: Twitter 的內容如果超過英文 280 字或是中文 140 字的話，多餘的內容將會被 Twitter 自動忽略。
     *
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        $_content = Str::limit($content, 20, ' ...');

        return '#純靠北工程師' . base_convert($options['id'], 10, 36) . "\n\r----------\n\r" .
            $_content . "\n\r----------\n\r" .
            '🗳️ [群眾審核] ' . route('frontend.social.cards.review') . "\n\r" .
            '👉 [GitHub Repo] https://github.com/init-engineer/init.engineer' . "\n\r" .
            '📢 [匿名發文] ' . route('frontend.social.cards.create') . "\n\r" .
            '🥙 [全平台留言] ' . route('frontend.social.cards.show', ['id' => $options['id']]);

        // return sprintf(
        //     "#純靠北工程師%s\r\n%s\r\n%s\r\n📢 匿名發文請至 %s\r\n🥙 全平台留言 %s",
        //     base_convert($options['id'], 10, 36),
        //     $_content,
        //     '👉 去 GitHub 給我們🌟用行動支持純靠北工程師 https://github.com/init-engineer/init.engineer',
        //     route('frontend.social.cards.create'),
        //     route('frontend.social.cards.show', ['id' => $options['id']])
        // );
    }
}
