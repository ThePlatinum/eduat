<?php

namespace Database\Seeders;

use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $students = User::with('class')->whereHas("roles", function ($q) {
      $q->where("name", "Student");
    })->get();

    foreach ($students as $student ) {
      $subjects = $student->class->subjects;

      foreach ($subjects as $subject) {
        $assessments = $subject->assessments;

        foreach ($assessments as $assessment) {
          $score = random_int(1, $assessment->grade_point);
          Score::create([
            'user_id' => $student->id,
            'assessment_id' => $assessment->id,
            'score' => $score,
          ]);
        }
      }
    }
  }
}
