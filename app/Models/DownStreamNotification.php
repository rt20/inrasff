<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\NotificationService;

class DownStreamNotification extends Model
{
    use HasFactory, HasHistory, HasStatus, SoftDeletes;

    protected $fillable = [
        'number',
        'notif_id',
        'title',
        // 'number_ref',
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

    protected $appends = [ 'status_label', 'status_class', 'origin_source', 'source', 'product_category'];
    private $states = [
        'draft' => [ 'label' => 'Draft', 'class' => 'info' ],
        'open' => [ 'label' => 'Dibuka', 'class' => 'info' ],
        'ccp process' => [ 'label' => 'Proses CCP', 'class' => 'warning' ],
        // 'ext process' => [ 'label' => 'Proses Eksternal', 'class' => 'warning' ],
        'done' => [ 'label' => 'Selesai', 'class' => 'success' ],
    ];

    public function getProductCategoryAttribute(){
        if($this->category_product_id==null){
            return null;
        }
        
        $data = NotificationService::productCategory($this->category_product_id);
        return $data;
    }
    
    public function getOriginSourceAttribute(){
        switch ($this->origin_source_notif) {
            case 'local':
                $data = NotificationService::notificationSource();
                return $data[$this->source_notif]['label'];
                // return "Dalam Negeri";
                break;

            case 'interlocal':
                $data = NotificationService::notificationSource(null);
                return $data[$this->source_notif]['label'];
                // return "Luar Negeri";
                break;
            
            default:
                return "";
                break;
        }
    }

    public function getSourceAttribute(){
        switch ($this->origin_source_notif) {
            case 'local':
                return "Dalam Negeri";
                break;

            case 'interlocal':
                return "Luar Negeri";
                break;
            
            default:
                return "";
                break;
        }
    }

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

    public function attachment(){
        return $this->morphMany(NotificationAttachment::class, 'na');
    }

    /**
     * Access Permission of Institution and User Access
     */
    
    public function downstreamInstitution()
    {
        return $this->hasMany(DownStreamInstitution::class, 'ds_id', 'id');
    }

    public function downstreamUserAccess()
    {
        return $this->hasMany(DownStreamUserAccess::class, 'downstream_id', 'id');
    }

    /**
     * Get the notificationStatus that owns the DownStreamNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notificationStatus()
    {
        return $this->belongsTo(NotificationStatus::class, 'status_notif_id');
    }

    /**
     * Get the notificationType that owns the DownStreamNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class, 'type_notif_id');
    }

    /**
     * Get the country that owns the DownStreamNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Get the baseNotification that owns the DownStreamNotification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseNotification()
    {
        return $this->belongsTo(NotificationBase::class, 'based_notif_id');
    }
    

    /**
     * @override save function for DownStreamNotification
     */

    // public function save(array $options = []){
        
    //     parent::save();
    // }
}
