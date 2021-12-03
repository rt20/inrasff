<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\UpStreamNotification;

class UpStreamNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $upstream;

    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UpStreamNotification $upstream, User $user)
    {
        $this->user = $user;
        $this->upstream = $upstream;
        $this->title = $upstream->number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('inrasff@pom.go.id')
            ->subject('[INRASFF-Assign] ' . $this->title)
            ->view('mail.upstream_notification');
    }
}
