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


    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'na_type', 'na_id');
    }

    public function getOriginAttribute()
    {

        if ($this->link == null)
            return '#';
        return route('backadmin.attachments.view-notification-attachment', $this->id);
    }

    public function getInfoLabelAttribute()
    {
        if ($this->info != null)
            return self::INFOS[$this->info]['label'];

        return  null;
    }

    /**
     * Override Delete
     */
    public function delete()
    {
        if ($this->link != null) {
            File::delete(storage_path('app/notification/attachment/' . $this->link));
        }
        parent::delete();
    }

    /**
     * Override Save
     */
    public function save(array $options = [])
    {
        if ($this->info !== null && $this->type_id == null) {
            $this->type_id = AttachmentType::where('info', $this->info)->first()->id;
        }
        parent::save();
    }
}
