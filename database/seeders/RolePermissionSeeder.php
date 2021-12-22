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
            'lccp',
            'notifier'
        ]);

        $masterDataPermissions = $this->createPermissions([
            'notification',
            // 'news',
            // 'slider',
            'user',
            'institution'
        ]);

        $frontPermissions = $this->createPermissions([
            // 'categories',
            'news_categories',
            'news',
            'faq',
            'kementrian',
            'contact_us',
            'gallery',
            'slider'
        ]);

        $labelSubPermission = $this->createPermissions([
            'data',
            'bussiness_process',
            'front_end',
            'master_data',
        ],[
            'view'
        ]
        );

        $dashboardPermission = $this->createPermissions([
            'ccp_stats'
        ],[
            'view'
        ]);

        $sideDataPermissions = $this->createPermissions([
            'dangerous',
            'risk',
            'traceability',
            'border_control',
            'attachment'
        ]);

        $downstreamSideDataPermissions = $this->createPermissions([
            'd_dangerous',
            'd_risk',
            'd_traceability',
            'd_border_control',
            'd_attachment'
        ]);

        $upstreamSideDataPermissions = $this->createPermissions([
            'u_dangerous',
            'u_risk',
            'u_traceability',
            'u_border_control',
            'u_attachment'
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
        $processPermissions['upstream']['store_institution'] = Permission::create(['name' => 'store_institution upstream']);
        $processPermissions['upstream']['delete_institution'] = Permission::create(['name' => 'delete_institution upstream']);
        
        $processPermissions['downstream']['process_ccp'] = Permission::create(['name' => 'process_ccp downstream']);
        $processPermissions['downstream']['process_ext'] = Permission::create(['name' => 'process_ext downstream']);
        $processPermissions['downstream']['finish'] = Permission::create(['name' => 'finish downstream']);
        $processPermissions['downstream']['store_institution'] = Permission::create(['name' => 'store_institution downstream']);
        $processPermissions['downstream']['delete_institution'] = Permission::create(['name' => 'delete_institution downstream']);
        

        $processPermissions['follow_up']['process'] = Permission::create(['name' => 'process follow_up']);
        $processPermissions['follow_up']['accept'] = Permission::create(['name' => 'accept follow_up']);
        $processPermissions['follow_up']['reject'] = Permission::create(['name' => 'reject follow_up']);

        $masterDataPermissions['user']['change_password'] = Permission::create(['name' => 'change_password user']);
        /** Notifier Roles */
        $this->assignEntityActionPermissions(
            $roles['notifier'],
            $masterDataPermissions,
            [
                'notification' => [
                    'store',
                    'view',
                    'delete'
                ]
            ]
        );

        $this->assignEntityPermissions(
            $roles['notifier'],
            $labelSubPermission,
            [
                'data'
            ]
        );

        /**NCP Roles */
        $this->assignEntityPermissions(
            $roles['ncp'],
            $masterDataPermissions,
            [
                // 'notification',
                'institution',
                // 'news',
                // 'slider',
                'user'
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['ncp'],
            $masterDataPermissions,
            [
                'notification' => ['view'],
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $processPermissions,
            [
                'notification',
                'downstream',
                'upstream',
                'follow_up'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $sideDataPermissions,
            [
                'dangerous',
                'risk',
                'traceability',
                'border_control',
                'attachment'
            ]
        );

        
        $this->assignEntityPermissions(
            $roles['ncp'],
            $labelSubPermission,
            [
                'data',
                'bussiness_process',
                'front_end',
                'master_data'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $downstreamSideDataPermissions,
            [
                'd_dangerous',
                'd_risk',
                'd_traceability',
                'd_border_control',
                'd_attachment'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $upstreamSideDataPermissions,
            [
                'u_dangerous',
                'u_risk',
                'u_traceability',
                'u_border_control',
                'u_attachment'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ncp'],
            $frontPermissions,
            [
                'news_categories',
                'news',
                'faq',
                'kementrian',
                'contact_us',
                'gallery',
                'slider'
            ]
        );
        
        $this->assignEntityPermissions(
            $roles['ncp'],
            $dashboardPermission,
            [
                'ccp_stats',
            ]
        );

        /**CCP Roles */
        // $this->assignEntityActionPermissions(
        //     $roles['ccp'],
        //     $masterDataPermissions,
        //     [
        //         'notification' => ['view'],
        //     ]
        // );

        $this->assignEntityPermissions(
            $roles['ccp'],
            $masterDataPermissions,
            [
                'institution',
                // 'news',
                'user'
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['ccp'],
            $sideDataPermissions,
            [
                'dangerous' => ['view'],
                'risk' => ['view'],
                'traceability' => ['view'],
                'border_control' => ['view'],
                'attachment' => ['view']
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['ccp'],
            $processPermissions,
            [
                'downstream' => [
                    'view all',
                    'view',
                    'store_institution',
                    'delete_institution',
                ],

                'upstream' => [
                    'view all',
                    'view',
                    'store', 
                    'delete',
                    'store_institution',
                    'delete_institution',
                ],

                'follow_up' => [
                    'view all',
                    'view',
                    'accept'
                ],
                // 'notification' => [
                //     'process_upstream'
                // ]
            ]
        );

        $this->assignEntityPermissions(
            $roles['ccp'],
            $labelSubPermission,
            [
                'front_end',
                // 'data',
                'bussiness_process',
                'master_data'
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['ccp'],
            $downstreamSideDataPermissions,
            [
                'd_dangerous' => ['view'],
                'd_risk' => ['view'],
                'd_traceability' => ['view'],
                'd_border_control' => ['view'],
                'd_attachment' => ['view']
            ]
        );

        $this->assignEntityPermissions(
            $roles['ccp'],
            $upstreamSideDataPermissions,
            [
                'u_dangerous',
                'u_risk',
                'u_traceability',
                'u_border_control',
                'u_attachment'
            ]
        );

        $this->assignEntityPermissions(
            $roles['ccp'],
            $frontPermissions,
            [
                'news',
            ]
        );

        /**
         * LCCP Role
         */
        // $this->assignEntityActionPermissions(
        //     $roles['lccp'],
        //     $masterDataPermissions,
        //     [
        //         'notification' => ['view'],
        //     ]
        // );
        

        $this->assignEntityActionPermissions(
            $roles['lccp'],
            $sideDataPermissions,
            [
                'dangerous' => ['view'],
                'risk' => ['view'],
                'traceability' => ['view'],
                'border_control' => ['view'],
                'attachment' => ['view']
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
                    'store', 
                    'delete'
                ],
                'follow_up' => [
                    'view all',
                    'view',
                ],
                // 'notification' => [
                //     'process_upstream'
                // ]
            ]
        );

        $this->assignEntityPermissions(
            $roles['lccp'],
            $labelSubPermission,
            [
                // 'data',
                'bussiness_process',
            ]
        );

        $this->assignEntityActionPermissions(
            $roles['lccp'],
            $downstreamSideDataPermissions,
            [
                'd_dangerous' => ['view'],
                'd_risk' => ['view'],
                'd_traceability' => ['view'],
                'd_border_control' => ['view'],
                'd_attachment' => ['view']
            ]
        );

        $this->assignEntityPermissions(
            $roles['lccp'],
            $upstreamSideDataPermissions,
            [
                'u_dangerous',
                'u_risk',
                'u_traceability',
                'u_border_control',
                'u_attachment'
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
