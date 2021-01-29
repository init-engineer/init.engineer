<?php

namespace App\Services\Socials\MediaCards;

use Exception;
use App\Models\Auth\User;
use App\Models\Social\Cards;
use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Repositories\Backend\Social\MediaCardsRepository;
use Illuminate\Support\Str;
use Telegram\Bot\Api;

/**
 * Class TelegramPrimaryService.
 */
class TelegramPrimaryService extends BaseService implements SocialCardsContract
{
    /**
     *
     */
    protected $telegram;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * TelegramPrimaryService constructor.
     */
    public function __construct(MediaCardsRepository $mediaCardsRepository)
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $this->mediaCardsRepository = $mediaCardsRepository;
    }

    /**
     * @param Cards $cards
     * @return MediaCards
     */
    public function publish(Cards $cards)
    {
        if ($this->mediaCardsRepository->findByCardId($cards->id, 'telegram', 'primary')) {
            throw new GeneralException(__('exceptions.backend.social.media.cards.repeated_error'));
        } else {
            try {
                $response = $this->telegram->sendPhoto([
                    'chat_id' => config('social.telegram.primary.user_id'),
                    'photo' => $cards->images->first()->getPicture(),
                    'caption' => $this->buildContent($cards->content, [
                        'id' => $cards->id,
                    ])
                ]);

                return $this->mediaCardsRepository->create([
                    'card_id' => $cards->id,
                    'model_id' => $cards->model_id,
                    'social_type' => 'telegram',
                    'social_connections' => 'primary',
                    'social_card_id' => $response['message_id'],
                ]);
            } catch (Exception $e) {
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
        if ($mediaCards = $this->mediaCardsRepository->findByCardId($cards->id, 'telegram', 'primary')) {
            try {
                return $mediaCards;
            } catch (Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        return false;
    }

    /**
     * 注意: Telegram 採用 sendPhoto 時，其圖片 Caption 字元長度為 0-1024。
     *
     * @param string $content
     * @return string
     */
    public function buildContent($content = '', array $options = [])
    {
        $_content = Str::limit($content, 800, ' ...');

        return "\n\r----------\n\r" .
            $_content . "\n\r----------\n\r" .
            '🗳️ [群眾審核] ' . route('frontend.social.cards.review') . "\n\r" .
            '👉 [GitHub Repo] https://github.com/init-engineer/init.engineer' . "\n\r" .
            '📢 [匿名發文] ' . route('frontend.social.cards.create') . "\n\r" .
            '🥙 [全平台留言] ' . route('frontend.social.cards.show', ['id' => $options['id']]);
    }
}
