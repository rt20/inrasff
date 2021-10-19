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
        'symptom',
        'voluntary_measures',
        'add_voluntary_measures',
        'compulsory_measures',
        'add_compulsory_measures'
    ];

    const MEASURE = [
        'informing recipients' => [
            'label' => 'Informing recipients',
            'add_form' => null
        ],
        'physical treatment' => [
            'label' => 'Physical treatment',
            'add_form' => 'select'
        ],
        'product to-be' => [
            'label' => 'Product (to be)',
            'add_form' => 'select'
        ],
        'product to-be used as' => [
            'label' => 'Product (to be) used as',
            'add_form' => 'input'
        ],
        'product recall and withdrawal' => [
            'label' => 'Product recall and withdrawal',
            'add_form' => null
        ],
        'prohibiton to use' => [
            'label' => 'Prohibition to use',
            'add_form' => null
        ],
        'public warning' => [
            'label' => 'Public warning / press release (hyperlink)',
            'add_form' => 'input'
        ],
        'reinforced checking' => [
            'label' => 'Reinforced checking',
            'add_form' => null
        ],
        'other' => [
            'label' => 'Other / more info',
            'add_form' => 'input'
        ]
    ];

    const PHYSICAL_TREATMENT = [
        'acid treatment',
        'blanching',
        'freezing',
        'heat treatment',
        'sorting',
    ];

    const PRODUCT_TO_BE = [
        'destroyed',
        'detained',
        'recalled from consumers',
        'redispatched',
        'relabeled',
        'returned to dispatcher',
        'seized',
        'under customs seals',
        'withdrawn from the market',
    ];

    public static function productToBeList(){
        return self::PRODUCT_TO_BE;
    }

    public static function physicalTreatmentList(){
        return self::PHYSICAL_TREATMENT;
    }

    public static function measureList(){
        return self::MEASURE;
    }

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
