<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'distribution_status',
        'distribution_status_id',
        'serious_risk',
        'victim',
        'symptom'
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'ri_type', 'ri_id');
    }

    /**
     * Get the distributionStatus associated with the RiskInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function distributionStatus()
    {
        return $this->hasOne(DistributionStatus::class, 'id', 'distribution_status_id');
    }
}
