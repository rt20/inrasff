<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\NotificationAttachment;
use App\Models\FollowUpNotificationAttachment;
use Illuminate\Support\Facades\Gate;

class AttachmentController extends Controller
{
    public function viewNotificationAttachment($id){
        
        $na = NotificationAttachment::find($id);
        if($na==null)
            abort(404);
        // return $na;
        
        // if (!Gate::allows('view notification')) {
        //     abort(401);
        // }


        if(str_replace('App\\Models\\', '', $na->na_type)==='UpStreamNotification'){
            $institution_access =  $na->notification->upstreamInstitution()->pluck('institution_id')->toArray();
        }elseif(str_replace('App\\Models\\', '', $na->na_type)==='DownStreamNotification'){
            $institution_access =  $na->notification->downstreamInstitution()->pluck('institution_id')->toArray();
            if(!in_array(auth()->user()->type, ['superadmin', 'ncp'])){
                if(!in_array($na->notification->status, ['ccp process', 'done'])){
                    abort(401);
                }
            }
        }

        if(str_replace('App\\Models\\', '', $na->na_type)==='Notification'){
            if(!in_array(auth()->user()->type, ['superadmin', 'ncp', 'notifier'])){
                abort(401);
            }
        }

        if(!in_array(auth()->user()->type, ['superadmin', 'ncp'])){
            if(!in_array(auth()->user()->institution_id, $institution_access)){
                abort(401);
            }
        }
            
        return Storage::disk('local')->response('notification/attachment/'.$na->link, $na->link);
    }

    public function viewFollowUpAttachment($id){
        $na = FollowUpNotificationAttachment::find($id);
        if($na==null)
            abort(404);        
        
            if($na==null)
            abort(404);
        
        if(str_replace('App\\Models\\', '', $na->followUp->fun_type)==='UpStreamNotification'){
            $institution_access =  $na->followUp->notification->upstreamInstitution()->pluck('institution_id')->toArray();
        }else{
            $institution_access =  $na->followUp->notification->downstreamInstitution()->pluck('institution_id')->toArray();
            if(!in_array(auth()->user()->type, ['superadmin', 'ncp'])){
                if(!in_array($na->followUp->notification->status, ['ccp process', 'done'])){
                    // return redirect()->route('backadmin.downstreams.index');
                    abort(401);
                }
            }
        }

        if(!in_array(auth()->user()->type, ['superadmin', 'ncp'])){
            if(!in_array(auth()->user()->institution_id, $institution_access)){
                abort(401);
            }
        }
        return Storage::disk('local')->response('follow_up/attachment/'.$na->link, $na->link);
    }
}
