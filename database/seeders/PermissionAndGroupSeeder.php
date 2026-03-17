<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionAndGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = config('admin.auth_guard', 'web');
        $rolesConfig = config('admin.roles', []);
        $permissionsConfig = config('admin.permissions', []);
        $groupNames = array_merge([
            'Super Admin',
        ], array_map(fn($role) => $role['label'], $rolesConfig));

        $groups = [];
        $permissions = [];
        foreach ($groupNames as $group_name) {
            $groups[$group_name] = Role::findOrCreate($group_name, $guardName);
        }

        foreach ($permissionsConfig as $perm_name) {
            $permissions[$perm_name] = Permission::findOrCreate($perm_name, $guardName);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach ($rolesConfig as $roleKey => $roleConfig) {
            $role_name = $roleConfig['label'];
            $role = $groups[$role_name];

            if (!$role) continue;

            $perms_to_assign = $roleConfig['permissions'];

            if (in_array('*', $perms_to_assign)) {
                $role->syncPermissions(array_values($permissions));
            } else {
                $resolvedPermissions = [];
                foreach ($perms_to_assign as $perm_name) {
                    if (isset($permissions[$perm_name])) {
                        $resolvedPermissions[] = $permissions[$perm_name];
                    }
                }

                $role->syncPermissions($resolvedPermissions);
            }
        }

        if (isset($groups['Super Admin'])) {
            $groups['Super Admin']->syncPermissions(array_values($permissions));
        }
    }
}
