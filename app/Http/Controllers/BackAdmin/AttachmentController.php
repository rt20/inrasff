<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\NotificationAttachment;
use App\Models\FollowUpNotificationAttachment;

class AttachmentController extends Controller
{
    public function viewNotificationAttachment($id){
        $na = NotificationAttachment::find($id);
        if($na==null)
            abort(404);
        
            
        return Storage::disk('local')->response('notification/attachment/'.$na->link, $na->link);
    }

    public function viewFollowUpAttachment($id){
        $na = FollowUpNotificationAttachment::find($id);
        if($na==null)
            abort(404);        
            
        return Storage::disk('local')->response('follow_up/attachment/'.$na->title);
    }
}
