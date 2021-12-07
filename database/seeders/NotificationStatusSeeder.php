<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationStatus;

class NotificationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationStatus::insert([
            [
                'name' => 'Penolakan di Perbatasan - Border Rejection'
            ],
            [
                'name' => 'Waspada - Alert'
            ],
            [
                'name' => 'Informasi - Information'
            ],
            [
                'name' => 'Berita - News'
            ],
        ]);
    }
}
