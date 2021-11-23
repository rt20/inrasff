<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\DownStreamUserAccess;

class DownStreamNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_access;
    public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DownStreamUserAccess $user_access)
    {
        $this->user_access = $user_access;
        $this->title = $user_access->downstream->number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('system@inrasff.com')
            ->subject('[INRASFF-Assign] ' . $this->title)
            ->view('mail.downstream_notification');
    }
}
