<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraceabilityLotInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_country_id',
        'number',
        'used_by',
        'best_before',
        'sell_by',
        'number_unit',
        'net_weight',
        'cert_number',
        'cert_date',
        'cert_institution',
        'add_cert_number',
        'add_cert_date',
        'add_cert_institution'
    ];

    public function notification(){
        return $this->morphTo(__FUNCTION__, 'tli_type', 'tli_id');
    }
}
