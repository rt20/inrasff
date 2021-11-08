<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institution::insert([
            [
                'name' => 'BPOM'
            ],
            [
                'name' => 'Kementrian Kelautan dan Perikanan'
            ],
            [
                'name' => 'Kementrian Pertanian'
            ],
            [
                'name' => 'Direktorat Jenderal Bea dan Cukai'
            ],
        ]);
    }
}
