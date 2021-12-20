<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\FollowUpNotification as Fun;
use App\Models\User;

class FollowUpNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $fun;
    public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Fun $fun, User $user)
    {
        $this->user = $user;
        $this->fun = $fun;
        $this->title = "[".$fun->notification->number." ".$fun->title."]";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('inrasff@pom.go.id')
            ->subject('[INRASFF-FOLLOW-UP-NOTIFICATION] ' . $this->title)
            ->view('mail.follow_up_notification');
    }
}
