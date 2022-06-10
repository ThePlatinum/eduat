<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Klass;
use App\Models\Subjects;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssessmentsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //

    $subjects = Subjects::all();

    $types = ['Test', 'Quiz', 'Assignment', 'Midterm'];

    foreach ($subjects as $subject) {
      foreach ($types as $type) {
        $i = 0;
        Assessment::create([
          'subject_id' => $subject->id,
          'type' => $type,
          'cesion_id' => 1,
          'term_id' => 1,
          'title' => $type,
          'grade_point' => random_int(5, 50),
          'assessed_at' => Carbon::now()->subDays(random_int(3, 10))
        ]);
        $i++;
      }
    }

    foreach ($subjects as $subject) {
      Assessment::create([
        'subject_id' => $subject->id,
        'type' => 'Final',
        'cesion_id' => 1,
        'term_id' => 1,
        'title' => 'Examination',
        'grade_point' => 60,
        'assessed_at' => now(),
      ]);
    }
  }
}
