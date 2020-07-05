<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        Role::create(['name' => config('access.users.admin_role')]);
        Role::create(['name' => config('access.users.junior_vip_role')]);
        Role::create(['name' => config('access.users.senior_vip_role')]);
        Role::create(['name' => config('access.users.expert_vip_role')]);
        Role::create(['name' => config('access.users.legend_vip_role')]);
        Role::create(['name' => config('access.users.junior_donate_role')]);
        Role::create(['name' => config('access.users.senior_donate_role')]);
        Role::create(['name' => config('access.users.expert_donate_role')]);
        Role::create(['name' => config('access.users.legend_donate_role')]);
        Role::create(['name' => config('access.users.junior_user_role')]);
        Role::create(['name' => config('access.users.senior_user_role')]);
        Role::create(['name' => config('access.users.expert_user_role')]);
        Role::create(['name' => config('access.users.legend_user_role')]);
        Role::create(['name' => config('access.users.junior_manager_role')]);
        Role::create(['name' => config('access.users.senior_manager_role')]);
        Role::create(['name' => config('access.users.expert_manager_role')]);
        Role::create(['name' => config('access.users.legend_manager_role')]);
        Role::create(['name' => config('access.users.default_role')]);

        // Create Permissions
        Permission::create(['name' => 'view backend']);

        // Assign Permissions to other Roles
        // Note: Admin (User 1) Has all permissions via a gate in the AuthServiceProvider
        // $user->givePermissionTo('view backend');

        $this->enableForeignKeys();
    }
}
