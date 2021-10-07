<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Countries;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries =  Countries::getList('id', 'php');
        $countries_array = [];
        foreach ($countries as $key => $value) {
            array_push($countries_array, [
                'code' => $key,
                'name' => $value
            ]);
        }
        Country::insert($countries_array);
    }
}
