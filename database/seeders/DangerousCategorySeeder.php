<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DangerousCategory;

class DangerousCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DangerousCategory::insert([
            [
                'name' => "Bahaya Kimia"
            ],
            [
                'name' => "Bahaya Mikrobiologi"
            ],
            [
                'name' => "Bahaya Fisik"
            ],
            [
                'name' => "Mutu"
            ],
            [
                'name' => "Dokumen"
            ],
        ]);
    }
}
