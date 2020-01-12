<?php

namespace App\Services\Socials\MediaCards;

use Exception;
use Qlurk\ApiClient;
use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Social\MediaCardsRepository;

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
     * @return MediaCards
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'plurk', 'primary'))
        {
            throw new GeneralException(__('exceptions.backend.social.media.cards.repeated_error'));
        }
        else
        {
            try
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

                return $this->mediaCardsRepository->create([
                    'card_id' => $cards->id,
                    'model_id' => $cards->model_id,
                    'social_type' => 'plurk',
                    'social_connections' => 'primary',
                    'social_card_id' => base_convert($response['plurk_id'], 10, 36),
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
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'plurk', 'primary'))
        {
            try
            {
                $response = $this->plurk->call('/APP/Timeline/getPlurk', [
                    'plurk_id'   => base_convert($mediaCards->social_card_id, 36, 10),
                    'count'      => 'all'
                ]);
                return $this->mediaCardsRepository->update($mediaCards, [
                    'num_like' => $response['plurk']['favorite_count'],
                    'num_share' => $response['plurk']['replurkers_count'],
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
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'plurk', 'primary'))
        {
            try
            {
                $response = $this->plurk->call('/APP/Timeline/plurkDelete', ['plurk_id' => base_convert($mediaCards->social_card_id, 36, 10)]);

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
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        $_content = (mb_strlen($content, 'utf-8') > 100)? mb_substr($content, 0, 100, 'utf-8') . ' ...' : $content;

        return sprintf(
            "%s\r\n#純靠北工程師%s\r\n%s\r\n%s\r\n🥙 全平台留言 %s",
            $options['image_url'],
            base_convert($options['id'], 10, 36),
            $_content,
            '👉 去 GitHub 給我們🌟用行動支持純靠北工程師 https://github.com/init-engineer/init.engineer',
            route('frontend.social.cards.show', ['id' => $options['id']])
        );
    }
}
