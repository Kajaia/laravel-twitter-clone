<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTweetsReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tweets;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $tweets)
    {
        $this->user = $user;
        $this->tweets = $tweets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('New tweets reminder')
            ->markdown('mails.new-tweets');
    }
}
