<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UomResult;

class UomResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UomResult::insert([
            [
                'name' => 'ppm',
            ],
            [
                'name' => 'kol/g',
            ],
            [
                'name' => 'g',
            ],
            [
                'name' => 'buah',
            ],
            [
                'name' => 'batang',
            ],
            [
                'name' => 'ppb',
            ],
            [
                'name' => '/25g',
            ],
            [
                'name' => 'ng/g',
            ],
        ]);
    }
}
