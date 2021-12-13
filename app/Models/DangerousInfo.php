<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        
        // 'name_result',
        // 'uom_result_id',
        // 'laboratorium',
        // 'matrix',
        // 'scope',
        // 'max_tollerance',
        
        'cl1_id',
        'cl2_id',
        'cl3_id'
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
    // public function category()
    // {
    //     return $this->hasOne(DangerousCategory::class, 'id', 'category_id');
    // }

    /**
     * Get all of the sampling for the DangerousInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sampling()
    {
        return $this->hasMany(DangerousSamplingInfo::class, 'di_id', 'id');
    }

    public function delete(){
        $this->sampling()->delete();
        parent::delete();
    }
}
