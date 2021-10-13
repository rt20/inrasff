<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraceabilityLotDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'tl_id'
    ];

    /**
     * Get the traceabilityLot that owns the TraceabilityLotDistribution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function traceabilityLot()
    {
        return $this->belongsTo(TraceabilityLotInfo::class, 'tl_id');
    }

    /**
     * Get the country that owns the TraceabilityLotDistribution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }


}
