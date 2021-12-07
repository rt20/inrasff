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
        'di_id'
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
}
