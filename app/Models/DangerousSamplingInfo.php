<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousSamplingInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'sampling_date',
        'sampling_count',
        'sampling_method',
        'sampling_place',
        'di_id',

        'name_result',
        'uom_result_id',
        'laboratorium',
        'matrix',
        'scope',
        'max_tollerance'
    ];

    protected $casts = [
        'sampling_date' => 'date:Y-m-d',
    ];

    /**
     * Get the danger that owns the DangerousSamplingInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function danger()
    {
        return $this->belongsTo(DangerousInfo::class, 'di_id');
    }

    /**
     * Get the uom that owns the DangerousSamplingInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uom()
    {
        return $this->belongsTo(UomResult::class, 'uom_result_id');
    }
}
