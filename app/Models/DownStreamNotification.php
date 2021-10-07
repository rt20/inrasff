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
        'notif_id'
    ];

    protected $appends = [ 'status_label', 'status_class',];
    private $states = [
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
    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notif_id');
    }
}
