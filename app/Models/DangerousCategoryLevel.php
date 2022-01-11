<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousCategoryLevel extends Model
{
    use HasFactory;

    /**
     * Get the dangerousCategory associated with the DangerousCategoryLevel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dangerousCategory()
    {
        return $this->hasOne(DangerousCategory::class, 'id', 'dc_id');
    }

    public function parent()
    {
        if ($this->parent_id != null) {
            return DangerousCategoryLevel::where('id', $this->parent_id)->first();
        }
        return null;
    }
}
