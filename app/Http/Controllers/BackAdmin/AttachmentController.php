<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\NotificationAttachment;

class AttachmentController extends Controller
{
    public function viewNotificationAttachment($id){
        $na = NotificationAttachment::find($id);
        if($na==null)
            abort(404);
        
            
        return Storage::disk('local')->response('notification/attachment/'.$na->link, $na->link);
        // return response()
            
        //     ->file(
        //         Storage::disk('local')->path('notification/attachment/'.$na->link),
        //         'Ganteng'
        //     );
    }
}
