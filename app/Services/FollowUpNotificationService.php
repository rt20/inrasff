<?php

namespace App\Services;

use App\Models\FollowUpNotification as Fun;
use App\Events\FollowUpEmailNotification;

class FollowUpNotificationService{
    
    public static function sendMailNotification(Fun $fun){
        event(new FollowUpEmailNotification($fun));
    }
}