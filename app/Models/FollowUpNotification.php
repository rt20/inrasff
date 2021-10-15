<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpNotification extends Model
{
    use HasFactory, HasHistory, HasStatus;
    
    protected $fillable = [
        'title',
        'description',
    ];

    protected $appends = [ 'status_label', 'status_class',];
    private $states = [
        'draft' => [ 'label' => 'Draft', 'class' => 'info' ],
        'on process' => [ 'label' => 'Diproses', 'class' => 'warning' ],
        'accepted' => [ 'label' => 'Disetujui', 'class' => 'success' ],
        'rejected' => [ 'label' => 'Selesai', 'class' => 'danger' ],
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'fun_type', 'fun_id');
    }
}
