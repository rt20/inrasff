<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

use Faker\Factory as Faker;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');
        
        $notifications = [];
        $source = [
            'Internal',
            'ARASFF',
            'KBRI/Atase',
            'INFOSAN'
        ];
        for ($i=0; $i < 50; $i++) { 
            array_push($notifications,
                [
                    'title' => $faker->catchPhrase,
                    'number' => $faker->creditCardNumber,
                    'description' => $faker->text,
                    'source' => $source[random_int(0,3)],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
        Notification::insert($notifications);
    }
}
