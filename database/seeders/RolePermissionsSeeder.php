<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::query()
            ->create([
                'name' => 'admin',
                'guard_name' => 'admin'
            ]);

        $company = Role::query()
            ->create([
                'name' => 'company',
                'guard_name' => 'company'
            ]);

        $employee = Role::query()->create([
            'name' => 'employee',
            'guard_name' => 'company',
        ]);


        $permissions = [
            'company:create',
            'company:delete',
            'company:update',
            'company:view',
            'company:view-any',

            'employee:create',
            'employee:delete',
            'employee:update',
            'employee:view',
            'employee:view-any',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);

            // Company uchun permission
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'company',
            ]);
        }

        $admin->givePermissionTo([
            'company:create',
            'company:delete',
            'company:update',
            'company:view',
            'company:view-any',
            'employee:view',
            'employee:view-any',
        ]);

        $company->givePermissionTo([
            'employee:create',
            'employee:delete',
            'employee:update',
            'employee:view',
            'employee:view-any',
            'company:update',
            'company:view',
            'company:delete',
            'company:create',
            'company:view-any',
        ]);

        $employee->givePermissionTo([
            'employee:view',
            'employee:view-any',
        ]);
    }
}
