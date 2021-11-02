<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        foreach ($users as $user) {
            $u = User::factory()->create([
                'username' => $user['username'],
                'fullname' => $user['name'],
                'email' => $user['username'] . '@bpom.com',
                'type' => $user['role'],
            ]);

            $u->assignRole($roles[$user['role']]);

        }
        
    }
}
