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
        'add_cert_institution',
        'cved_number',
        /**
         * Produsen
         */
        'producer_name',
        'producer_address',
        'producer_city',
        'producer_country_id',
        'producer_approval',

        /**
         * Importir
         */
        'importer_name',
        'importer_address',
        'importer_city',
        'importer_country_id',
        'importer_approval',

        /**
         * Wholesaler
         */
        'wholesaler_name',
        'wholesaler_address',
        'wholesaler_city',
        'wholesaler_country_id',
        'wholesaler_approval',
    ];

    public function notification(){
        return $this->morphTo(__FUNCTION__, 'tli_type', 'tli_id');
    }

    /**
     * Get the sourceCountry associated with the TraceabilityLotInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sourceCountry()
    {
        return $this->hasOne(Country::class, 'id', 'source_country_id');
    }

    public function producerCountry()
    {
        return $this->hasOne(Country::class, 'id', 'producer_country_id');
    }

    public function importerCountry()
    {
        return $this->hasOne(Country::class, 'id', 'importer_country_id');
    }

    public function wholesalerCountry()
    {
        return $this->hasOne(Country::class, 'id', 'wholesaler_country_id');
    }

    /**
     * Get all of the distributions for the TraceabilityLotInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distributions()
    {
        return $this->hasMany(TraceabilityLotDistribution::class, 'tl_id', 'id');
    }
}
