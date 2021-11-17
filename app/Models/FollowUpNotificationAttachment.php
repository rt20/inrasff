<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class FollowUpNotificationAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'fun_id'
    ];
    protected $appends = [
        'origin'
    ];
    /**
     * Get the followUp that owns the FollowUpNotificationAttachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function followUp()
    {
        return $this->belongsTo(FollowUpNotification::class, 'fun_id');
    }

    public function getOriginAttribute(){

        if($this->title == null)
            return '#' ;
        return route('backadmin.attachments.view-follow-up-attachment', $this->id);
    }

    /**
     * Override Delete
     */
    public function delete(){
        if($this->title != null){
            
            File::delete(storage_path('app/follow_up/attachment/'.$this->title));
        }
        parent::delete();
    }
}
