<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = $this->createRoles([
            'superadmin',
            'ncp',
            'ccp',
            'lccp'
        ]);

        $masterDataPermissions = $this->createPermissions([
            'notification',
            'news',
            'slider',
            'user'
        ]);

        $processPermissions = $this->createPermissions([
            'downstream',
            'upstream',
            'follow_up'
        ],[
            'view all',
            'view',
            'store',
            'delete',
        ]);

        $processPermissions['notification']['process_downstream'] = Permission::create(['name' => 'process_downstream notification']);
        $processPermissions['notification']['process_upstream'] = Permission::create(['name' => 'process_upstream notification']);

        $processPermissions['upstream']['process_ccp'] = Permission::create(['name' => 'process_ccp upstream']);
        $processPermissions['upstream']['process_ext'] = Permission::create(['name' => 'process_ext upstream']);
        $processPermissions['upstream']['finish'] = Permission::create(['name' => 'finish upstream']);

        $processPermissions['downstream']['process_ccp'] = Permission::create(['name' => 'process_ccp downstream']);
        $processPermissions['downstream']['process_ext'] = Permission::create(['name' => 'process_ext downstream']);
        $processPermissions['downstream']['finish'] = Permission::create(['name' => 'finish downstream']);
        

        $processPermissions['follow_up']['process'] = Permission::create(['name' => 'process follow_up']);
        $processPermissions['follow_up']['accept'] = Permission::create(['name' => 'accept follow_up']);
        $processPermissions['follow_up']['reject'] = Permission::create(['name' => 'reject follow_up']);

        /**NCP Roles */
        $this->assignEntityPermissions(
            $roles['ncp'],
            $masterDataPermissions,
            [
                'notification',
                'news',
                'slider',
                'user'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $processPermissions,
            [
                'downstream',
                'upstream',
                'follow_up'
            ]
        );

        /**CCP Roles */
        $this->assignEntityActionPermissions(
            $roles['ccp'],
            $masterDataPermissions,
            [
                'notification' => ['view'],
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['ccp'],
            $processPermissions,
            [
                'downstream' => [
                    'view all',
                    'view',
                ],

                'upstream' => [
                    'view all',
                    'view',
                ],

                'follow_up' => [
                    'view all',
                    'view',
                ],
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['lccp'],
            $masterDataPermissions,
            [
                'notification' => ['view'],
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['lccp'],
            $processPermissions,
            [
                'downstream' => [
                    'view all',
                    'view',
                ],

                'upstream' => [
                    'view all',
                    'view',
                ],
                'follow_up' => [
                    'view all',
                    'view',
                ],
            ]
        );
    }

    public function createPermissions(array $entityList, array $actionList = ['view', 'store', 'delete'])
    {
        $permissions = [];
        foreach ($entityList as $entity) {
            foreach ($actionList as $action) {
                $permission = Permission::create(['name' => $action . ' ' . $entity]);
                $permissions[$entity][$action] = $permission;
            }
        }

        return $permissions;
    }

    public function createRoles(array $roleList)
    {
        $roles = [];
        foreach ($roleList as $role) {
            $roles[$role] = Role::create(['name' => $role]);
        }

        return $roles;
    }

    /**
     * givePermissionTo Array Parameter
     */

    public function assignEntityPermissions(Role $role, array $permissions, array $entities)
    {
        foreach ($entities as $entity) {
            $role->givePermissionTo($permissions[$entity]);
        }
    }

    /**
     * givePermissionTo Single Parameter
     */
    public function assignEntityActionPermissions(Role $role, array $permissions, array $entityActions)
    {
        foreach ($entityActions as $entity => $actions) {
            foreach ($actions as $action) {
                $role->givePermissionTo($permissions[$entity][$action]);
            }
        }
    }
}
