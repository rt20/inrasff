<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'superadmin',
            'fullname' => 'My Name Superadmin',
            'email' => 'superadmin' . '@bpom.com',
            'type' => 'superadmin',
        ]);

        $this->call([
            SliderSeeder::class,
            NotificationStatusSeeder::class,
            NotificationTypeSeeder::class,
            NotificationBaseSeeder::class,
            DangerousCategorySeeder::class,
            UomResultSeeder::class,
            
            NotificationSeeder::class,
            CountrySeeder::class,
            InstitutionSeeder::class,

        ]);
    }
}
