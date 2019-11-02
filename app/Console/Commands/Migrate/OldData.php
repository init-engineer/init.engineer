<?php

namespace App\Console\Commands\Migrate;

use Illuminate\Console\Command;
use App\Models\Social\Old\Cards as OldCards;
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

        /**
         * 撈出所有的舊架構文章
         */
        foreach (OldCards::all() as $_old_card)
        {
            /**
             * 搬移主要社群文章
             */
            if ($_card = $this->cardsRepository->findById($_old_card->id))
            {
                $card = $this->cardsRepository->update($_card, [
                    'id' => $_old_card->id,
                    'user_id' => $_old_card->user_id,
                    'content' => $_old_card->content,
                    'active' => $_old_card->active,
                    'is_banned' => isset($_old_card->deleted_at)? true : false,
                    'banned_user_id' => $_old_card->deleted_by_who,
                    'banned_remarks' => $_old_card->deleted_of_what,
                    'created_at' => $_old_card->created_at,
                    'updated_at' => $_old_card->updated_at,
                    'deleted_at' => $_old_card->deleted_at,
                ]);
            }
            else
            {
                $card = $this->cardsRepository->create([
                    'id' => $_old_card->id,
                    'user_id' => $_old_card->user_id,
                    'content' => $_old_card->content,
                    'active' => $_old_card->active,
                    'is_banned' => isset($_old_card->deleted_at)? true : false,
                    'banned_user_id' => $_old_card->deleted_by_who,
                    'banned_remarks' => $_old_card->deleted_of_what,
                    'created_at' => $_old_card->created_at,
                    'updated_at' => $_old_card->updated_at,
                    'deleted_at' => $_old_card->deleted_at,
                ]);
            }

            /**
             * 搬移 CardsImage 文章圖片
             */
            if ($_image = $this->imagesRepository->findById($_old_card->image->id))
            {
                $image = $this->imagesRepository->update($_image, [
                    'id' => $_old_card->image->id,
                    'card_id' => $card->id,
                    'user_id' => $_old_card->image->user_id,
                    'avatar_path' => $_old_card->image->file_path,
                    'avatar_name' => $_old_card->image->file_name,
                    'avatar_type' => $_old_card->image->file_type,
                    'active' => $_old_card->image->active,
                    'created_at' => $_old_card->image->created_at,
                    'updated_at' => $_old_card->image->updated_at,
                    'deleted_at' => $_old_card->image->deleted_at,
                ]);
            }
            else
            {
                $image = $this->imagesRepository->create([
                    'id' => $_old_card->image->id,
                    'card_id' => $card->id,
                    'user_id' => $_old_card->image->user_id,
                    'avatar_path' => $_old_card->image->file_path,
                    'avatar_name' => $_old_card->image->file_name,
                    'avatar_type' => $_old_card->image->file_type,
                    'active' => $_old_card->image->active,
                    'created_at' => $_old_card->image->created_at,
                    'updated_at' => $_old_card->image->updated_at,
                    'deleted_at' => $_old_card->image->deleted_at,
                ]);
            }

            /**
             * 搬移 Facebook 新粉絲團的社群文章，並且判斷是否已經寫入過。
             */
            if (isset($_old_card->facebook_new_card_id))
            {
                if ($_old_card->facebook_new_card_id != '-')
                {
                    if ($__facebook_new_card = $this->mediaCardsRepository->findByCardId($card->id, 'facebook', 'secondary'))
                    {
                        $_facebook_new_card = $this->mediaCardsRepository->update($__facebook_new_card, [
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'facebook',
                            'social_connections' => 'secondary',
                            'social_card_id' => $_old_card->facebook_new_card_id,
                            'num_like' => $_old_card->facebook_new_card_like,
                            'num_share' => $_old_card->facebook_new_card_share,
                            'active' => $_old_card->facebook_new_card_active,
                            'is_banned' => $_old_card->facebook_new_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                    else
                    {
                        $_facebook_new_card = $this->mediaCardsRepository->create([
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'facebook',
                            'social_connections' => 'secondary',
                            'social_card_id' => $_old_card->facebook_new_card_id,
                            'num_like' => $_old_card->facebook_new_card_like,
                            'num_share' => $_old_card->facebook_new_card_share,
                            'active' => $_old_card->facebook_new_card_active,
                            'is_banned' => $_old_card->facebook_new_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                }
            }

            /**
             * 搬移 Facebook 舊粉絲團的社群文章，並且判斷是否已經寫入過。
             */
            if (isset($_old_card->facebook_old_card_id))
            {
                if ($_old_card->facebook_old_card_id != '-')
                {
                    if ($__facebook_old_card = $this->mediaCardsRepository->findByCardId($card->id, 'facebook', 'primary'))
                    {
                        $_facebook_old_card = $this->mediaCardsRepository->update($__facebook_old_card, [
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'facebook',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->facebook_old_card_id,
                            'num_like' => $_old_card->facebook_old_card_like,
                            'num_share' => $_old_card->facebook_old_card_share,
                            'active' => $_old_card->facebook_old_card_active,
                            'is_banned' => $_old_card->facebook_old_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                    else
                    {
                        $_facebook_old_card = $this->mediaCardsRepository->create([
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'facebook',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->facebook_old_card_id,
                            'num_like' => $_old_card->facebook_old_card_like,
                            'num_share' => $_old_card->facebook_old_card_share,
                            'active' => $_old_card->facebook_old_card_active,
                            'is_banned' => $_old_card->facebook_old_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                }
            }

            /**
             * 搬移 Twitter 的社群文章，並且判斷是否已經寫入過。
             */
            if (isset($_old_card->twitter_card_id))
            {
                if ($_old_card->twitter_card_id != '-')
                {
                    if ($__twitter_card = $this->mediaCardsRepository->findByCardId($card->id, 'twitter', 'primary'))
                    {
                        $_twitter_card = $this->mediaCardsRepository->update($__twitter_card, [
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'twitter',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->twitter_card_id,
                            'num_like' => $_old_card->twitter_card_like,
                            'num_share' => $_old_card->twitter_card_share,
                            'active' => $_old_card->twitter_card_active,
                            'is_banned' => $_old_card->twitter_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                    else
                    {
                        $_twitter_card = $this->mediaCardsRepository->create([
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'twitter',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->twitter_card_id,
                            'num_like' => $_old_card->twitter_card_like,
                            'num_share' => $_old_card->twitter_card_share,
                            'active' => $_old_card->twitter_card_active,
                            'is_banned' => $_old_card->twitter_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                }
            }

            /**
             * 搬移 Plurk 的社群文章，並且判斷是否已經寫入過。
             */
            if (isset($_old_card->plurk_card_id))
            {
                if ($_old_card->plurk_card_id != '-')
                {
                    if ($__plurk_card = $this->mediaCardsRepository->findByCardId($card->id, 'plurk', 'primary'))
                    {
                        $_plurk_card = $this->mediaCardsRepository->update($__plurk_card, [
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'plurk',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->plurk_card_id,
                            'num_like' => $_old_card->plurk_card_like,
                            'num_share' => $_old_card->plurk_card_share,
                            'active' => $_old_card->plurk_card_active,
                            'is_banned' => $_old_card->plurk_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                    else
                    {
                        $_plurk_card = $this->mediaCardsRepository->create([
                            'card_id' => $card->id,
                            'user_id' => $_old_card->user_id,
                            'social_type' => 'plurk',
                            'social_connections' => 'primary',
                            'social_card_id' => $_old_card->plurk_card_id,
                            'num_like' => $_old_card->plurk_card_like,
                            'num_share' => $_old_card->plurk_card_share,
                            'active' => $_old_card->plurk_card_active,
                            'is_banned' => $_old_card->plurk_card_active,
                            'banned_user_id' => $_old_card->deleted_by_who,
                            'banned_remarks' => $_old_card->deleted_of_what,
                            'created_at' => $_old_card->created_at,
                            'updated_at' => $_old_card->updated_at,
                            'deleted_at' => $_old_card->deleted_at,
                        ]);
                    }
                }
            }

            /**
             * 搬移所有社群文章的留言與回覆。
             */
            foreach ($_old_card->comments as $_old_comment)
            {
                switch ($_old_comment->social_type)
                {
                    /**
                     * 搬移 Facebook 新粉絲團的社群文章的留言。
                     */
                    case 'Facebook New':
                        if ($__facebook_new_comment = $this->commentsRepository->findByMediaAndUserAndContent(
                            $card->id,
                            $_facebook_new_card->id,
                            $_old_comment->social_comment_id,
                            $_old_comment->social_user_id,
                            $_old_comment->content))
                        {
                            $_facebook_new_comment = $this->commentsRepository->update($__facebook_new_comment, [
                                'card_id' => $card->id,
                                'media_id' => $_facebook_new_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'reply_media_comment_id' => $_old_comment->reply_by,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        else
                        {
                            $_facebook_new_comment = $this->commentsRepository->create([
                                'card_id' => $card->id,
                                'media_id' => $_facebook_new_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'reply_media_comment_id' => $_old_comment->reply_by,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        break;

                    /**
                     * 搬移 Facebook 舊粉絲團的社群文章的留言。
                     */
                    case 'Facebook Old':
                        if ($__facebook_old_comment = $this->commentsRepository->findByMediaAndUserAndContent(
                            $card->id,
                            $_facebook_old_card->id,
                            $_old_comment->social_comment_id,
                            $_old_comment->social_user_id,
                            $_old_comment->content))
                        {
                            $_facebook_old_comment = $this->commentsRepository->update($__facebook_old_comment, [
                                'card_id' => $card->id,
                                'media_id' => $_facebook_old_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'reply_media_comment_id' => $_old_comment->reply_by,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        else
                        {
                            $_facebook_old_comment = $this->commentsRepository->create([
                                'card_id' => $card->id,
                                'media_id' => $_facebook_old_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'reply_media_comment_id' => $_old_comment->reply_by,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        break;

                    /**
                     * 搬移本平台的社群文章的留言。
                     */
                    case 'Platform':
                        if ($__platform_comment = $this->commentsRepository->findByMediaAndUserAndContent(
                            $card->id,
                            null,
                            null,
                            $_old_comment->social_user_id,
                            $_old_comment->content))
                        {
                            $_platform_comment = $this->commentsRepository->update($__platform_comment, [
                                'card_id' => $card->id,
                                'media_id' => null,
                                'media_comment_id' => null,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        else
                        {
                            $_platform_comment = $this->commentsRepository->create([
                                'card_id' => $card->id,
                                'media_id' => null,
                                'media_comment_id' => null,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        break;

                    /**
                     * 搬移 Plurk 的社群文章的留言。
                     */
                    case 'Plurk':
                        if ($__plurk_comment = $this->commentsRepository->findByMediaAndUserAndContent(
                            $card->id,
                            $_plurk_card->id,
                            $_old_comment->social_comment_id,
                            $_old_comment->social_user_id,
                            $_old_comment->content))
                        {
                            $_plurk_comment = $this->commentsRepository->update($__plurk_comment, [
                                'card_id' => $card->id,
                                'media_id' => $_plurk_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        else
                        {
                            $_plurk_comment = $this->commentsRepository->create([
                                'card_id' => $card->id,
                                'media_id' => $_plurk_card->id,
                                'media_comment_id' => $_old_comment->social_comment_id,
                                'user_id' => $_old_comment->social_user_id,
                                'user_name' => $_old_comment->social_user_name,
                                'user_avatar' => $_old_comment->avatar_url,
                                'content' => $_old_comment->content,
                                'active' => true,
                                'is_banned' => false,
                                'banned_user_id' => null,
                                'banned_remarks' => null,
                                'created_at' => $_old_comment->created_at,
                                'updated_at' => $_old_comment->updated_at,
                                'deleted_at' => $_old_comment->deleted_at,
                            ]);
                        }
                        break;
                }
            }
        }
    }
}
