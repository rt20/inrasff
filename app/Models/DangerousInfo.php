<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'name_result',
        'uom_result',
        'laboratorium',
        'matrix',
        'scope',
        'max_tollerance',
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'di_type', 'di_id');
    }
}
