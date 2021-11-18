<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NotificationAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'link',
        'info'
    ];

    protected $appends = [
        'origin',
        'info_label'
    ];

    const INFOS = [
        'main_info' => [
            'label' => 'Informasi Utama'
        ],
        'dangerous_risk' => [
            'label' => 'Bahaya dan Resiko'
        ],
        'traceability_lot' => [
            'label' => 'Keterlusuran Lot'
        ],
        'border_control' => [
            'label' => 'Kontrol Perbatasan'
        ]
    ];


    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'na_type', 'na_id');
    }

    public function getOriginAttribute(){

        if($this->link == null)
            return '#' ;
        return route('backadmin.attachments.view-notification-attachment', $this->id);
        
        
    }

    public function getInfoLabelAttribute(){
        if($this->info != null)
            return self::INFOS[$this->info]['label'];

        return  null;
    }

    /**
     * Override Delete
     */
    public function delete(){
        if($this->link != null){
            File::delete(storage_path('app/notification/attachment/'.$this->link));
        }
        parent::delete();
    }
}
