<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class NotificationAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];

    protected $appends = [
        'origin'
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'na_type', 'na_id');
    }

    public function getOriginAttribute(){

        if($this->title == null)
            return '#' ;
        return asset('storage/notification/attachment/'.$this->title);
    }

    /**
     * Override Delete
     */
    public function delete(){
        if($this->title != null){
            File::delete(storage_path('app/public/notification/attachment/'.$this->title));
        }
        parent::delete();
    }
}
