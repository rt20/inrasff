<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\DownStreamNotificationMail;
use App\Models\DownStreamUserAccess;

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
        // $user_access = $event->user_access;
        // $user = $event->user_access->user;
        $downstream = $event->downstream;
        $dsi = $event->dsi;
        // $dsInstitutions = $downstream->downstreamInstitution;

        foreach ($dsi->institution->users as $i => $user) {
            Mail::to($user->email)
                ->send(new DownStreamNotificationMail($downstream, $user));
        }
        // foreach ($dsInstitutions as $i => $dsInstitution) {
        //     if($dsInstitution->status === 'draft'){
        //         $dsInstitution->status = 'assigned';
        //         $dsInstitution->save();
        //         foreach ($dsInstitution->institution->users as $k => $user) {
        //                 Mail::to($user->email)
        //                 ->send(new DownStreamNotificationMail($downstream, $user));
        //         }
        //     }
        // }

        
    }
}
