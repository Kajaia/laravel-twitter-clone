<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;

    public $user;
    public $content;
    public $tweetId;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $content, $tweetId)
    {
        $this->user = $user;
        $this->content = $content;
        $this->tweetId = $tweetId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            'user' => $this->user->name,
            'content' => $this->content,
            'tweet_id' => $this->tweetId
        ];
    }
}
