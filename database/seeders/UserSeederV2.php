<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Institution;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class UserSeederV2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $roles = Role::all()->keyBy('name');

        /**
         * Super Admin
         */

        $u = User::factory()->make([
            'username' => 'superadmin',
            'fullname' => 'superadmin',
            'email' => 'superadmin@inrasff.com',
            'type' => 'superadmin',
            'responsible_name' => $faker->name,
            'responsible_phone' => $faker->phoneNumber,
            'responsible_address' => $faker->address,
        ]);
        $u->save();
        $u->assignRole('superadmin');

         /**
          * NCP
          */

        $u = User::factory()->make([
            'username' => 'ncp_1',
            'fullname' => 'NCP #1',
            'email' => 'ncp_1@inrasff.com',
            'type' => 'ncp',
            'responsible_name' => $faker->name,
            'responsible_phone' => $faker->phoneNumber,
            'responsible_address' => $faker->address,
        ]);
        $u->save();
        $u->assignRole('ncp');
        
        $ccps = Institution::where('type', 'ccp')->get();
        echo "\nTotal CCP: ".sizeof($ccps);

        foreach ($ccps as $i => $ccp) {
            $u = User::factory()->make([
                'username' => 'ccp_'.($i+1),
                'fullname' => 'CCP #'.($i+1),
                'email' => 'ccp_'.($i+1).'@inrasff.com',
                'type' => 'ccp',
                'responsible_name' => $faker->name,
                'responsible_phone' => $faker->phoneNumber,
                'responsible_address' => $faker->address,
                'institution_id' => $ccp->id
            ]);
            $u->save();
            $u->assignRole('ccp');            
        }

        echo "\nCCP Done";

        $lccps = Institution::where('type', 'lccp')->get();
        echo "\nTotal LCCP: ".sizeof($lccps);

        foreach ($lccps as $i => $lccp) {
            $u = User::factory()->make([
                'username' => 'lccp_'.($i+1),
                'fullname' => 'LCCP #'.($i+1),
                'email' => 'lccp_'.($i+1).'@inrasff.com',
                'type' => 'lccp',
                'responsible_name' => $faker->name,
                'responsible_phone' => $faker->phoneNumber,
                'responsible_address' => $faker->address,
                'institution_id' => $lccp->id
            ]);
            $u->save();
            $u->assignRole('lccp');            
        }

        echo "\nLCCP Done";
    }
}
