<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\FollowUpNotificationMail;

class SendFollowUpNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $fun = $event->fun;
        foreach ($fun->followUpInstitution as $i => $fui) {
            foreach ($fui->institution->users as $u => $user) {
                Mail::to($user->email)
                    ->send(new FollowUpNotificationMail($fun, $user));
            }
        }
    }
}
