<?php

namespace Database\Seeders;

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

    $user = User::create([
      'firstname' => 'Super',
      'lastname'  => 'Eduat',
      'othername' => 'Admin',
      'email'     => 'admin@eduat.com',
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Admin');
  }
}
