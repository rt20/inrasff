<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorderControlInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_point',
        'entry_point',
        'supervision_point',
        'destination_country_id', //destination country
        'consignee_name',
        'consignee_address',
        'container_number',
        'transport_name',
        'transport_description',
    ];

    public function notification()
    {
        return $this->morphTo(__FUNCTION__, 'bci_type', 'bci_id');
    }

    /**
     * Get the destinationCountry associated with the BorderControlInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function destinationCountry()
    {
        return $this->hasOne(Country::class, 'id', 'destination_country_id');
    }
}
