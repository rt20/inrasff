<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UpStreamNotification extends Model
{
    use HasFactory, HasHistory, HasStatus, SoftDeletes;

    protected $fillable = [
        'number',
        'notif_id',
        'title',
        'number_ref',
        'status_notif_id',
        'type_notif_id',
        'country_id',
        'based_notif_id',
        'origin_source_notif',
        'source_notif',
        'date_notif',
        'product_name',
        'category_product_id',
        'brand_name',
        'registration_number',
        'package_product',
        'institution',
        'contact_person',
        'others'
    ];

    protected $appends = [ 'status_label', 'status_class',];
    private $states = [
        'draft' => [ 'label' => 'Draft', 'class' => 'info' ],
        'open' => [ 'label' => 'Dibuka', 'class' => 'info' ],
        'ncp process' => [ 'label' => 'Proses NCP', 'class' => 'warning' ],
        'done' => [ 'label' => 'Selesai', 'class' => 'success' ],
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notif_id');
    }

    public function dangerousRisk(){
        return $this->morphOne(DangerousRiskInfo::class, 'dri');
    }

    public function dangerous(){
        return $this->morphMany(DangerousInfo::class, 'di');
    }

    public function risks(){
        return $this->morphMany(RiskInfo::class, 'ri');
    }

    public function traceabilityLot(){
        return $this->morphMany(TraceabilityLotInfo::class, 'tli');
    }

    public function borderControl(){
        return $this->morphMany(BorderControlInfo::class, 'bci');
    }

    public function followUp(){
        return $this->morphMany(FollowUpNotification::class, 'fun');
    }

    public function attachment(){
        return $this->morphMany(NotificationAttachment::class, 'na');
    }

}
