<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpStreamInstitution extends Model
{
    use HasFactory;

    protected $fillable = [
        'us_id',
        'institution_id',
        'read',
        'write'
    ];

    /**
     * Get the downstream that owns the DownStreamInstitution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upstream()
    {
        return $this->belongsTo(UpStreamNotification::class, 'us_id');
    }

    /**
     * Get the institution that owns the DownStreamInstitution
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
