<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class FollowUpNotificationAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'fun_id',
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
            'label' => 'Informasi Umum'
        ],
        'dangerous_risk' => [
            'label' => 'Bahaya dan Resiko'
        ],
        'traceability_lot' => [
            'label' => 'Keterlusuran Lot'
        ],
        'border_control' => [
            'label' => 'Kontrol Perbatasan'
        ],
        'health_certificate' => [
            'label' => 'Health Certificate'
        ],
        'cved_ced' => [
            'label' => 'CVED/CED'
        ],
        'phytosanitary_certificate' => [
            'label' => 'Phytosanitary Certificate'
        ],
        'public_warning' => [
            'label' => 'Public Warning / Press Release'
        ],
        'analytical_report' => [
            'label' => 'Analytical Report'
        ],
        'bills' => [
            'label' => 'Bills / Delivery Document'
        ],
        'pictures' => [
            'label' => 'Pictures'
        ],
        'risk_assessment' => [
            'label' => 'Risk Assessment'
        ],
        'original_notification' => [
            'label' => 'Original Notification'
        ],
        
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

    public function getInfoLabelAttribute(){
        if($this->info != null)
            return self::INFOS[$this->info]['label'];

        return  null;
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
