<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangerousRiskInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_dangerous',
        'category_dangerous',
        'name_result',
        'uom_result',
        'laboratorium',
        'matrix',
        'scope',
        'max_tollerance',
        'distribution_status',
        'serious_risk',
        'victim',
        'symptom'
    ];
}
