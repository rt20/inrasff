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
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        
        $this->call([
            SliderSeeder::class,
            NotificationStatusSeeder::class,
            NotificationTypeSeeder::class,
            NotificationBaseSeeder::class,
            DangerousCategorySeeder::class,
            UomResultSeeder::class,
            DistributionStatusSeeder::class,
            
            NotificationSeeder::class,
            CountrySeeder::class,
            InstitutionSeeder::class,

        ]);
    }
}
