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
        for ($i=0; $i < 50; $i++) { 
            array_push($notifications,
                [
                    'title' => $faker->catchPhrase,
                    'description' => $faker->text,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
        Notification::insert($notifications);
    }
}
