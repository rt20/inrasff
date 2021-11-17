<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousCategory extends Model
{
    use HasFactory;

    /**
     * Get all of the levels for the DangerousCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levels()
    {
        return $this->hasMany(DangerousCategoryLevel::class, 'dc_id', 'id');
    }
}
