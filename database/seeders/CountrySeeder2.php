<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = [
            76, // ID
            204, //SG
            138, //MY
            34, //BN
            90, //KH
            241, //VN
            222, //TH
            124, //LA
            155, //MM
            52, //PH
        ];

        Country::whereIn('id', $ids)->update([
            'is_asean' =>true
        ]);

        $indonesia = Country::where('name', 'like', 'Indonesia')->first();
        $indonesia->is_local = true;
        $indonesia->update();
    }
}
