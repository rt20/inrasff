<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
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
        $users = [
            [ 
                'name' => 'Super Admin',
                'role' => 'superadmin',
                'username' => 'superadmin'
            ],
            [ 
                'name' => 'Admin Direktorat Pengawasan Peredaran Pangan Olahan',
                'role' => 'ncp',
                'username' => 'ncp_1'
            ],
            [ 
                'name' => 'Direktur Pengawasan Peredaran Pangan Olahan',
                'role' => 'ncp',
                'username' => 'ncp_2'
            ],
            [ 
                'name' => 'Kementerian Pertanian',
                'role' => 'ccp',
                'username' => 'ccp_1'
            ],
            [ 
                'name' => 'Kementerian Kelautan dan Perikanan',
                'role' => 'ccp',
                'username' => 'ccp_2'
            ],
            [ 
                'name' => 'Kementerian Perindustrian',
                'role' => 'ccp',
                'username' => 'ccp_3'
            ],
            
        ];

        $ncp = 1;
        $ccp = 1;
        $lccp = 1;
        foreach ($users as $user) {
            if($user['role']==='ccp'){
                $u = User::factory()->create([
                    // 'username' => $user['username'],
                    'username' => $user['role']."_".$ccp,
                    'fullname' => $user['name'],
                    'email' => $user['username'] . '@inrasff.com',
                    'type' => $user['role'],
                ]);
                $ccp++;
            }else if ($user['role']==='lccp'){
                $u = User::factory()->create([
                    // 'username' => $user['username'],
                    'username' => $user['role']."_".$lccp,
                    'fullname' => $user['name'],
                    'email' => $user['username'] . '@inrasff.com',
                    'type' => $user['role'],
                ]);
                $lccp++;
            }else if($user['role']==='ncp'){
                $u = User::factory()->create([
                    // 'username' => $user['username'],
                    'username' => $user['role']."_".$ncp,
                    'fullname' => $user['name'],
                    'email' => $user['username'] . '@inrasff.com',
                    'type' => $user['role'],
                ]);
                $ncp++;
            }
            else{
                $u = User::factory()->create([
                    'username' => $user['username'],
                    'fullname' => $user['name'],
                    'email' => $user['username'] . '@inrasff.com',
                    'type' => $user['role'],
                ]);
            }

            $u->responsible_name = $faker->name;
            $u->responsible_phone = $faker->phoneNumber;
            $u->responsible_address = $faker->address;
            $u->update();
            

            $u->assignRole($roles[$user['role']]);

        }
        
    }
}
