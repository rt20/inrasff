<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationType::insert([
            [
                'name' => 'Food',
            ],
            [
                'name' => 'Feed',
            ],
        ]);
    }
}
