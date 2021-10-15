<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DownStreamNotification extends Model
{
    use HasFactory, HasHistory, HasStatus, SoftDeletes;

    protected $fillable = [
        'number',
        'notif_id',
        'title',
        'number_ref',
        'status_notif',
        'type_notif',
        'country_id',
        'based_notif',
        'origin_source_notif',
        'source_notif',
        'date_notif',
        'product_name',
        'category_product_name',
        'brand_name',
        'registration_number',
        'package_product'
    ];

    protected $appends = [ 'status_label', 'status_class',];
    private $states = [
        'draft' => [ 'label' => 'Draft', 'class' => 'info' ],
        'open' => [ 'label' => 'Dibuka', 'class' => 'info' ],
        'ccp process' => [ 'label' => 'Proses CCP', 'class' => 'warning' ],
        'ext process' => [ 'label' => 'Proses Eksternal', 'class' => 'warning' ],
        'done' => [ 'label' => 'Selesai', 'class' => 'success' ],
    ];

    /**
     * Get the notification that owns the DownStreamNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
    

    /**
     * @override save function for DownStreamNotification
     */

    public function save(array $options = []){
        
        parent::save();
        // if($this->dangerousRisk == null){
        //     $this->dangerousRisk()->create();
        // }
    }
}
