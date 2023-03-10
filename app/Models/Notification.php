<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, HasHistory, HasStatus, SoftDeletes;

    protected $fillable = [
        'title',
        'author_id',
        'number',
        'description',
    ];

    protected $appends = [ 'status_label', 'status_class',];

    private $states = [
        'unread' => [ 'label' => 'Belum Dibaca', 'class' => 'info' ],
        'read' => [ 'label' => 'Dibaca', 'class' => 'warning' ],
        'processed' => [ 'label' => 'Diproses', 'class' => 'success' ],
    ];

    /**
     * Get the downstream associated with the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function downstream()
    {
        return $this->hasOne(DownStreamNotification::class, 'notif_id', 'id');
    }

    public function upstream()
    {
        return $this->hasOne(UpStreamNotification::class, 'notif_id', 'id');
    }

    public function attachment(){
        return $this->morphMany(NotificationAttachment::class, 'na');
    }

}
