<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DistributionStatus;

class DistributionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DistributionStatus::insert([
            [
                'name' => 'Distribution on the Market (possible)',
            ],
            [
                'name' => 'Distribution Restricted to Notifying Country',
            ],
            [
                'name' => 'Distribution to Destination Under Customs Seals',
            ],
            [
                'name' => 'Information on Distribution not (yet) Available',
            ],
            [
                'name' => 'No Distribution',
            ],
            [
                'name' => 'No Stock Left',
            ],
            [
                'name' => 'Product Already Consumed',
            ],
            [
                'name' => 'Product Expired (past best before date)',
            ],
            [
                'name' => 'Product Expired (past use by date)',
            ],
        ]);
    }
}
