<?php

namespace Database\Seeders;

use App\Models\ClassTeacher;
use App\Models\Klass;
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
      StudentSeeder::class,
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

    // Create Teacher
    $user = User::create([
      'firstname' => 'Eduat',
      'lastname'  => 'Teacher',
      'othername' => 'User',
      'email'     => 'teacher@eduat.com',
      'phone'     => '07085781787',
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Teacher');

    // Create Student
    $user = User::create([
      'firstname' => 'Eduat',
      'lastname'  => 'Student',
      'othername' => 'User',
      'email'     => 'student@eduat.com',
      'phone'     => '+2347098765432',
      'klass_id'  => Klass::all()->random()->id +1,
      'password'  => Hash::make('12345678'),
      'created_at'=> now(),
    ]);

    $user->assignRole('Student');

    // Assign Class Teachers
    $teachers = User::role('Teacher')->get();
    $classes = Klass::where('id', '>', 1)->get();
    foreach ($classes as $class ) {
      $i = 1;
      ClassTeacher::create([
        'class_id' => $class->id,
        'teacher_id' => $teachers[$i]->id,
      ]);
      $i++;
    }

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

    $this->call([
      SubjectsSeeder::class,
      AssessmentsSeeder::class,
      ScoreSeeder::class,
      ItemsSeeder::class,
    ]);
  }
}
