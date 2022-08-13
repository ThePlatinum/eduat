<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // create permissions
    // Permission::create(['name' => 'edit articles']);

    Role::create(['name' => 'Admin']);
    Role::create(['name' => 'Accountant']);
    Role::create(['name' => 'Teacher']);
    Role::create(['name' => 'Student']);

    // $role->givePermissionTo('edit articles');
  }
}
