<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'category',
        'category_id',
        'name_result',
        // 'uom_result',
        'uom_result_id',
        'laboratorium',
        'matrix',
        'scope',
        'max_tollerance',
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'di_type', 'di_id');
    }

    /**
     * Get the category a the DangerousInfo
     *
     * @return \IlluminaDangerousCategory\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(DangerousCategory::class, 'id', 'category_id');
    }
}
