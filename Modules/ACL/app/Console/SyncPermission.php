<?php

namespace Modules\ACL\Console;

use Illuminate\Console\Command;
use Modules\ACL\Enums\AdministratorPermission;
use Modules\Administrator\Models\Administrator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:permission:sync';

    /**
     * The console command description.
     */
    protected $description = 'Sync permission and seed super admin\' permissions.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'administrator',
        ]);

        foreach (AdministratorPermission::toArray() as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'administrator',
            ]);
            $role->givePermissionTo($permission);
        }

        Administrator::first()->assignRole($role);
    }
}
