<?php

namespace Database\Seeders;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();

    $this->call(RolesAndPermissionsSeeder::class);

    // Create super admin
    $user = User::create([
      'firstname' => 'Super',
      'lastname'  => 'Eduat',
      'othername' => 'Admin',
      'email'     => 'admin@eduat.com',
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Admin');

    // Set School name
    Settings::create([
      'name' => 'school_name',
      'value' => 'Platinum College'
    ]);

    // Set number of sessions
    Settings::create([
      'name' => 'sessions',
      'value' => 3
    ]);
  }
}
