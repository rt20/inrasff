<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DownStreamNotificationMail;
// use App\Models\DownStreamUserAccess;

class SendDownStreamNotification implements ShouldQueue
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
        $downstream = $event->downstream;
        $user = $event->user;

        Mail::to($user->email)
                ->send(new DownStreamNotificationMail($downstream, $user));



        // $downstream = $event->downstream;
        // $dsi = $event->dsi;

        // foreach ($dsi->institution->users as $i => $user) {
        //     Mail::to($user->email)
        //         ->send(new DownStreamNotificationMail($downstream, $user));
        // }

        
    }
}
