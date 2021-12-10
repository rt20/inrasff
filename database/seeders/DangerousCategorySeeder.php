<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DangerousCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DangerousCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('dangerous_categories')->truncate();       

        DangerousCategory::insert([
            [
                'name' => "Bahaya Kimia",
                'has_child' => true
            ],
            [
                'name' => "Bahaya Mikrobiologi",
                'has_child' => true
            ],
            [
                'name' => "Bahaya Fisik",
                'has_child' => true
            ],
            [
                'name' => "Mutu",
                'has_child' => false
            ],
            [
                'name' => "Dokumen",
                'has_child' => true
            ],
            [
                'name' => "Label",
                'has_child' => true
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
