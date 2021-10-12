<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribution_status',
        'serious_risk',
        'victim',
        'symptom'
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'ri_type', 'ri_id');
    }
}
