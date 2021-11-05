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
                'name' => 'Kementerian Kesehatan'
            ],
            [
                'name' => 'Kementerian Perdagangan'
            ],
            [
                'name' => 'Kementrian Kelautan'
            ],            
            [
                'name' => 'Bea Cukai'
            ],
        ]);
    }
}
