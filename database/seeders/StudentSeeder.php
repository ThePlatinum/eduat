<?php

namespace Database\Seeders;

use App\Models\StudentClasses;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $qs = ['OND', 'B.Sc', 'B. Tech', 'HND'];
    // Create teacher
    for ($i = 0; $i < 5; $i++) {
      $teacher = User::factory()->create();
      $teacher->assignRole('Teacher');

      // Remove Class
      $teacher->klass_id = null;
      $teacher->qualification = $qs[random_int(0,3)];
      $teacher->save();
    }

    // Create student
    for ($i = 0; $i < 30; $i++) {
      $student = User::factory()->create();
      $student->assignRole('Student');

      StudentClasses::create([
        'student_id' => $student->id,
        'class_id' => $student->klass_id,
      ]);
    }
  }
}
