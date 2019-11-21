<?php

namespace App\Console\Commands\Migrate;

use Illuminate\Console\Command;

use App\Models\Social\Cards;
use App\Models\Social\Images;
use App\Models\Social\Comments;
use App\Models\Social\MediaCards;
use App\Models\Social\Old\Cards as OldCards;
use App\Models\Social\Old\Image as OldImages;
use App\Models\Social\Old\Comments as OldComments;
use App\Repositories\Backend\Social\CardsRepository;
use App\Repositories\Backend\Social\ImagesRepository;
use App\Repositories\Backend\Social\CommentsRepository;
use App\Repositories\Backend\Social\MediaCardsRepository;

/**
 * Class OldData.
 */
class OldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:oldData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '遷移資料庫舊資料到新結構當中。';

    /**
     * @var CardsRepository
     */
    protected $cardsRepository;

    /**
     * @var ImagesRepository
     */
    protected $imagesRepository;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepository;

    /**
     * @var MediaCardsRepository
     */
    protected $mediaCardsRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CardsRepository $cardsRepository,
        ImagesRepository $imagesRepository,
        CommentsRepository $commentsRepository,
        MediaCardsRepository $mediaCardsRepository)
    {
        parent::__construct();

        $this->cardsRepository = $cardsRepository;
        $this->imagesRepository = $imagesRepository;
        $this->commentsRepository = $commentsRepository;
        $this->mediaCardsRepository = $mediaCardsRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * 把單次執行記憶體上限擴充到 1 GB
         */
        ini_set('memory_limit', '1024M');

        foreach (OldCards::all() as $舊文章)
        {
            if ($新文章 = $this->搬移舊文章($舊文章))
            {
                $this->搬移舊圖片($舊文章, $新文章);
                $facebook主站社群文章 = $this->搬移Facebook主站社群文章($舊文章, $新文章);
                $facebook次站社群文章 = $this->搬移Facebook次站社群文章($舊文章, $新文章);
                $twitter主站社群文章  = $this->搬移Twitter主站社群文章($舊文章, $新文章);
                $plurk主站社群文章    = $this->搬移Plurk主站社群文章($舊文章, $新文章);
                foreach ($舊文章->comments as $舊留言)
                {
                    switch ($舊留言->social_type)
                    {
                        case 'Facebook New':
                            if ($facebook主站社群文章)
                            {
                                $this->搬移Facebook主站留言($舊留言, $新文章, $facebook主站社群文章);
                            }
                            else
                            {
                                $this->搬移本平台留言($舊留言, $新文章);
                            }
                            break;

                        case 'Facebook Old':
                            if ($facebook次站社群文章)
                            {
                                $this->搬移Facebook次站留言($舊留言, $新文章, $facebook次站社群文章);
                            }
                            else
                            {
                                $this->搬移本平台留言($舊留言, $新文章);
                            }
                            break;

                        case 'Twitter':
                            if ($twitter主站社群文章)
                            {
                                $this->搬移Twitter主站留言($舊留言, $新文章, $twitter主站社群文章);
                            }
                            else
                            {
                                $this->搬移本平台留言($舊留言, $新文章);
                            }
                            break;

                        case 'Plurk':
                            if ($plurk主站社群文章)
                            {
                                $this->搬移Plurk主站留言($舊留言, $新文章, $plurk主站社群文章);
                            }
                            else
                            {
                                $this->搬移本平台留言($舊留言, $新文章);
                            }
                            break;

                        default:
                            $this->搬移本平台留言($舊留言, $新文章);
                            break;
                    }
                }
            }
        }
    }

    /**
     * 搬移主要社群文章
     *
     * @param OldCards $舊文章
     * @return Cards
     */
    private function 搬移舊文章(OldCards $舊文章) : Cards
    {
        if ($新文章 = $this->cardsRepository->findById($舊文章->id))
        {
            return $this->cardsRepository->update($新文章, [
                'active' => $舊文章->active,
                'is_banned' => isset($舊文章->deleted_at)? true : false,
                'banned_user_id' => $舊文章->deleted_by_who,
                'banned_remarks' => $舊文章->deleted_of_what,
                'banned_at' => $舊文章->deleted_at,
                'created_at' => $舊文章->created_at,
                'updated_at' => $舊文章->updated_at,
            ]);
        }
        else
        {
            return $this->cardsRepository->create([
                'id' => $舊文章->id,
                'model_id' => $舊文章->user_id,
                'content' => $舊文章->content,
                'active' => $舊文章->active,
                'is_banned' => isset($舊文章->deleted_at)? true : false,
                'banned_user_id' => $舊文章->deleted_by_who,
                'banned_remarks' => $舊文章->deleted_of_what,
                'banned_at' => $舊文章->deleted_at,
                'created_at' => $舊文章->created_at,
                'updated_at' => $舊文章->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移 CardsImage 文章圖片
     *
     * @param OldCards $舊文章
     * @param Cards    $新文章
     * @return Images
     */
    private function 搬移舊圖片(OldCards $舊文章, Cards $新文章) : Images
    {
        if ($新圖片 = $this->imagesRepository->findById($舊文章->image->id))
        {
            return $新圖片;
        }
        else
        {
            return $this->imagesRepository->create([
                'id' => $舊文章->image->id,
                'card_id' => $新文章->id,
                'model_id' => $舊文章->image->user_id,
                'avatar_path' => $舊文章->image->file_path,
                'avatar_name' => $舊文章->image->file_name,
                'avatar_type' => $舊文章->image->file_type,
                'active' => $舊文章->image->active,
                'banned_at' => $舊文章->image->deleted_at,
                'created_at' => $舊文章->image->created_at,
                'updated_at' => $舊文章->image->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移 Facebook 主要粉絲團的社群文章，並且判斷是否已經寫入過。
     *
     * @param OldCards $舊文章
     * @param Cards    $新文章
     * @return MediaCards
     */
    private function 搬移Facebook主站社群文章(OldCards $舊文章, Cards $新文章)
    {
        if (isset($舊文章->facebook_old_card_id))
        {
            if ($舊文章->facebook_old_card_id != '-')
            {
                if ($facebook主站社群文章 = $this->mediaCardsRepository->findByCardId($新文章->id, 'facebook', 'primary'))
                {
                    return $this->mediaCardsRepository->update($facebook主站社群文章, [
                        'num_like' => $舊文章->facebook_old_card_like,
                        'num_share' => $舊文章->facebook_old_card_share,
                        'active' => $舊文章->facebook_old_card_active,
                        'is_banned' => $舊文章->facebook_old_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                    ]);
                }
                else
                {
                    return $this->mediaCardsRepository->create([
                        'card_id' => $新文章->id,
                        'model_id' => $舊文章->user_id,
                        'social_type' => 'facebook',
                        'social_connections' => 'primary',
                        'social_card_id' => $舊文章->facebook_old_card_id,
                        'num_like' => $舊文章->facebook_old_card_like,
                        'num_share' => $舊文章->facebook_old_card_share,
                        'active' => $舊文章->facebook_old_card_active,
                        'is_banned' => $舊文章->facebook_old_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                        'created_at' => $舊文章->created_at,
                        'updated_at' => $舊文章->updated_at,
                        'deleted_at' => null,
                    ]);
                }
            }
        }

        return false;
    }

    /**
     * 搬移 Facebook 次要粉絲團的社群文章，並且判斷是否已經寫入過。
     *
     * @param OldCards $舊文章
     * @param Cards    $新文章
     * @return MediaCards
     */
    private function 搬移Facebook次站社群文章(OldCards $舊文章, Cards $新文章)
    {
        if (isset($舊文章->facebook_new_card_id))
        {
            if ($舊文章->facebook_new_card_id != '-')
            {
                if ($facebook次站社群文章 = $this->mediaCardsRepository->findByCardId($新文章->id, 'facebook', 'secondary'))
                {
                    return $this->mediaCardsRepository->update($facebook次站社群文章, [
                        'num_like' => $舊文章->facebook_new_card_like,
                        'num_share' => $舊文章->facebook_new_card_share,
                        'active' => $舊文章->facebook_new_card_active,
                        'is_banned' => $舊文章->facebook_new_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                    ]);
                }
                else
                {
                    return $this->mediaCardsRepository->create([
                        'card_id' => $新文章->id,
                        'model_id' => $舊文章->user_id,
                        'social_type' => 'facebook',
                        'social_connections' => 'secondary',
                        'social_card_id' => $舊文章->facebook_new_card_id,
                        'num_like' => $舊文章->facebook_new_card_like,
                        'num_share' => $舊文章->facebook_new_card_share,
                        'active' => $舊文章->facebook_new_card_active,
                        'is_banned' => $舊文章->facebook_new_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                        'created_at' => $舊文章->created_at,
                        'updated_at' => $舊文章->updated_at,
                        'deleted_at' => null,
                    ]);
                }
            }
        }

        return false;
    }

    /**
     * 搬移 Twitter 的社群文章，並且判斷是否已經寫入過。
     *
     * @param OldCards $舊文章
     * @param Cards    $新文章
     * @return MediaCards
     */
    private function 搬移Twitter主站社群文章(OldCards $舊文章, Cards $新文章)
    {
        if (isset($舊文章->twitter_card_id))
        {
            if ($舊文章->twitter_card_id != '-')
            {
                if ($twitter主站社群文章 = $this->mediaCardsRepository->findByCardId($新文章->id, 'twitter', 'primary'))
                {
                    return $this->mediaCardsRepository->update($twitter主站社群文章, [
                        'num_like' => $舊文章->twitter_card_like,
                        'num_share' => $舊文章->twitter_card_share,
                        'active' => $舊文章->twitter_card_active,
                        'is_banned' => $舊文章->twitter_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                    ]);
                }
                else
                {
                    return $this->mediaCardsRepository->create([
                        'card_id' => $新文章->id,
                        'model_id' => $舊文章->user_id,
                        'social_type' => 'twitter',
                        'social_connections' => 'primary',
                        'social_card_id' => $舊文章->twitter_card_id,
                        'num_like' => $舊文章->twitter_card_like,
                        'num_share' => $舊文章->twitter_card_share,
                        'active' => $舊文章->twitter_card_active,
                        'is_banned' => $舊文章->twitter_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                        'created_at' => $舊文章->created_at,
                        'updated_at' => $舊文章->updated_at,
                        'deleted_at' => null,
                    ]);
                }
            }
        }

        return false;
    }

    /**
     * 搬移 Plurk 的社群文章，並且判斷是否已經寫入過。
     *
     * @param OldCards $舊文章
     * @param Cards    $新文章
     * @return MediaCards
     */
    private function 搬移Plurk主站社群文章(OldCards $舊文章, Cards $新文章)
    {
        if (isset($舊文章->plurk_card_id))
        {
            if ($舊文章->plurk_card_id != '-')
            {
                if ($plurk主站社群文章 = $this->mediaCardsRepository->findByCardId($新文章->id, 'plurk', 'primary'))
                {
                    return $this->mediaCardsRepository->update($plurk主站社群文章, [
                        'num_like' => $舊文章->plurk_card_like,
                        'num_share' => $舊文章->plurk_card_share,
                        'active' => $舊文章->plurk_card_active,
                        'is_banned' => $舊文章->plurk_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                    ]);
                }
                else
                {
                    return $this->mediaCardsRepository->create([
                        'card_id' => $新文章->id,
                        'model_id' => $舊文章->user_id,
                        'social_type' => 'plurk',
                        'social_connections' => 'primary',
                        'social_card_id' => $舊文章->plurk_card_id,
                        'num_like' => $舊文章->plurk_card_like,
                        'num_share' => $舊文章->plurk_card_share,
                        'active' => $舊文章->plurk_card_active,
                        'is_banned' => $舊文章->plurk_card_active,
                        'banned_user_id' => $舊文章->deleted_by_who,
                        'banned_remarks' => $舊文章->deleted_of_what,
                        'banned_at' => $舊文章->deleted_at,
                        'created_at' => $舊文章->created_at,
                        'updated_at' => $舊文章->updated_at,
                        'deleted_at' => null,
                    ]);
                }
            }
        }

        return false;
    }

    /**
     * 搬移 Facebook 主要粉絲團的社群文章的留言。
     *
     * @param OldComments $舊留言
     * @param Cards       $新文章
     * @param MediaCards  $facebook主站社群文章
     * @return Comments
     */
    private function 搬移Facebook主站留言(OldComments $舊留言, Cards $新文章, MediaCards $facebook主站社群文章) : Comments
    {
        if ($facebook主站社群文章留言 = $this->commentsRepository->findByMediaAndUserAndContent($新文章->id, $facebook主站社群文章->id, $舊留言->social_comment_id, $舊留言->social_user_id, $舊留言->content))
        {
            return $facebook主站社群文章留言;
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $新文章->id,
                'media_id' => $facebook主站社群文章->id,
                'media_comment_id' => $舊留言->social_comment_id,
                'user_id' => $舊留言->social_user_id,
                'user_name' => $舊留言->social_user_name,
                'user_avatar' => $舊留言->avatar_url,
                'content' => $舊留言->content,
                'active' => true,
                'reply_media_comment_id' => $舊留言->reply_by,
                'is_banned' => false,
                'banned_user_id' => null,
                'banned_remarks' => null,
                'created_at' => $舊留言->created_at,
                'updated_at' => $舊留言->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移 Facebook 次要粉絲團的社群文章的留言。
     *
     * @param OldComments $舊留言
     * @param Cards       $新文章
     * @param MediaCards  $facebook次站社群文章
     * @return Comments
     */
    private function 搬移Facebook次站留言(OldComments $舊留言, Cards $新文章, MediaCards $facebook次站社群文章) : Comments
    {
        if ($facebook次站社群文章留言 = $this->commentsRepository->findByMediaAndUserAndContent($新文章->id, $facebook次站社群文章->id, $舊留言->social_comment_id, $舊留言->social_user_id, $舊留言->content))
        {
            return $facebook次站社群文章留言;
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $新文章->id,
                'media_id' => $facebook次站社群文章->id,
                'media_comment_id' => $舊留言->social_comment_id,
                'user_id' => $舊留言->social_user_id,
                'user_name' => $舊留言->social_user_name,
                'user_avatar' => $舊留言->avatar_url,
                'content' => $舊留言->content,
                'active' => true,
                'reply_media_comment_id' => $舊留言->reply_by,
                'is_banned' => false,
                'banned_user_id' => null,
                'banned_remarks' => null,
                'created_at' => $舊留言->created_at,
                'updated_at' => $舊留言->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移 Twitter 主要粉絲團的社群文章的留言。
     *
     * @param OldComments $舊留言
     * @param Cards       $新文章
     * @param MediaCards  $twitter主站社群文章
     * @return Comments
     */
    private function 搬移Twitter主站留言(OldComments $舊留言, Cards $新文章, MediaCards $twitter主站社群文章)
    {
        if ($twitter主站社群文章留言 = $this->commentsRepository->findByMediaAndUserAndContent($新文章->id, $twitter主站社群文章->id, $舊留言->social_comment_id, $舊留言->social_user_id, $舊留言->content))
        {
            return $twitter主站社群文章留言;
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $新文章->id,
                'media_id' => $twitter主站社群文章->id,
                'media_comment_id' => $舊留言->social_comment_id,
                'user_id' => $舊留言->social_user_id,
                'user_name' => $舊留言->social_user_name,
                'user_avatar' => $舊留言->avatar_url,
                'content' => $舊留言->content,
                'active' => true,
                'reply_media_comment_id' => $舊留言->reply_by,
                'is_banned' => false,
                'banned_user_id' => null,
                'banned_remarks' => null,
                'created_at' => $舊留言->created_at,
                'updated_at' => $舊留言->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移 Plurk 主要粉絲團的社群文章的留言。
     *
     * @param OldComments $舊留言
     * @param Cards       $新文章
     * @param MediaCards  $plurk主站社群文章
     * @return Comments
     */
    private function 搬移Plurk主站留言(OldComments $舊留言, Cards $新文章, MediaCards $plurk主站社群文章) : Comments
    {
        if ($plurk主站社群文章留言 = $this->commentsRepository->findByMediaAndUserAndContent($新文章->id, $plurk主站社群文章->id, $舊留言->social_comment_id, $舊留言->social_user_id, $舊留言->content))
        {
            return $plurk主站社群文章留言;
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $新文章->id,
                'media_id' => $plurk主站社群文章->id,
                'media_comment_id' => $舊留言->social_comment_id,
                'user_id' => $舊留言->social_user_id,
                'user_name' => $舊留言->social_user_name,
                'user_avatar' => $舊留言->avatar_url,
                'content' => $舊留言->content,
                'active' => true,
                'reply_media_comment_id' => null,
                'is_banned' => false,
                'banned_user_id' => null,
                'banned_remarks' => null,
                'banned_at' => $舊留言->deleted_at,
                'created_at' => $舊留言->created_at,
                'updated_at' => $舊留言->updated_at,
                'deleted_at' => null,
            ]);
        }
    }

    /**
     * 搬移本平台的文章的留言。
     *
     * @param OldComments $舊留言
     * @param Cards       $新文章
     * @param MediaCards  $facebook主站社群文章
     * @return Comments
     */
    private function 搬移本平台留言(OldComments $舊留言, Cards $新文章) : Comments
    {
        if ($本平台文章留言 = $this->commentsRepository->findByMediaAndUserAndContent($新文章->id, null, null, $舊留言->social_user_id, $舊留言->content))
        {
            return $本平台文章留言;
        }
        else
        {
            return $this->commentsRepository->create([
                'card_id' => $新文章->id,
                'media_id' => null,
                'media_comment_id' => null,
                'user_id' => $舊留言->social_user_id,
                'user_name' => $舊留言->social_user_name,
                'user_avatar' => $舊留言->avatar_url,
                'content' => $舊留言->content,
                'active' => true,
                'is_banned' => false,
                'banned_user_id' => null,
                'banned_remarks' => null,
                'banned_at' => $舊留言->deleted_at,
                'created_at' => $舊留言->created_at,
                'updated_at' => $舊留言->updated_at,
                'deleted_at' => null,
            ]);
        }
    }
}
