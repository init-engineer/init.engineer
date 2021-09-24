<?php

namespace App\Domains\Social\Notifications\Frontend;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class PublishNotification.
 */
class PublishNotification extends Notification
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Cards
     */
    public $cards;

    /**
     * Create a notification instance.
     *
     * @param User $user
     * @param Cards $cards
     *
     * @return void
     */
    public function __construct(User $user, Cards $cards)
    {
        $this->user = $user;
        $this->cards = $cards;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('[:appName] 您的投稿(#:id)通過了審核！', [
                'appName' => appName(),
                'id' => base_convert($this->cards->id, 10, 36),
            ]))
            ->greeting(__('嗨囉！:user，', [
                'user' => $this->user->name,
            ]))
            ->line(__('我們在 :createdAt(:createdAtDiff) 收到了您的投稿，經過了繁複的群眾審核後，您的文章在 :publishAt(:publishAtDiff) 的時候達到通過門檻，並且發表出去了！恭喜！', [
                'createdAt' => $this->cards->created_at->toDatetimeString(),
                'createdAtDiff' => $this->cards->created_at->diffForHumans(),
                'publishAt' => $this->cards->updated_at->toDatetimeString(),
                'publishAtDiff' => $this->cards->updated_at->diffForHumans(),
            ]))
            ->line(__('「:content」', [
                'content' => $this->cards->content,
            ]))
            ->action(__('來去看看文章'), route('frontend.social.cards.show', ['id' => $this->cards->id]))
            ->line(__('對了，請不要回覆這封電子郵件(no-reply)！這個信箱不會理你，因為我也不會打開來收信，如果你有任何問題，你可以寄信給「:email」給我。', [
                'email' => config('mail.from.address'),
            ]))
            ->line(__('大概是這樣。'));
    }
}
