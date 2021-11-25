<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::insert([
            [
                'name' => 'Kementerian',
                'location' => 'kementerian',
                'settings' => json_encode([
                    'width' => 1280,
                    'height' => 720
                ])
            ],
        ]);
    }
}
