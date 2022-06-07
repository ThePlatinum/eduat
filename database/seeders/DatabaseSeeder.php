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

    $this->call([
      RolesAndPermissionsSeeder::class,
      ClassSeeder::class,
    ]);

    // Create super admin
    $user = User::create([
      'firstname' => 'Eduat',
      'lastname'  => 'Admin',
      'othername' => 'User',
      'email'     => 'admin@eduat.com',
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Admin');

    // Create accountant
    $user = User::create([
      'firstname' => 'Eduat',
      'lastname'  => 'Accountant',
      'othername' => 'User',
      'email'     => 'accountant@eduat.com',
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Accountant');

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
