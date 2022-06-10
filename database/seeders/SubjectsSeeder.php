<?php

namespace Database\Seeders;

use App\Models\Klass;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // 
      $names = [
        'Chemistry', 'Economics', 'Physics', 'Biology', 'Geography', 'History',
        'Civics', 'Agriculture', 'Commerce', 'Home Science', 'Literature',
        'ICT', 'Music', 'Art', 'Physical Education', 'Computer Science',
        'Business Studies', 'Accounting', 'Sports', 'Games', 'Drama', 'Dance',
        'Drawing', 'Painting', 'Singing', 'Photography', 'Film Making',
        'Visual Arts', 'Handwriting', 'Paste Art', 'Sketching', 'Crafting',
        'Cooking', 'Pastry', 'Dessert', 'Culinary Arts', 'Fashion', 'Jewellery',
        'Fashion Design', 'Jewellery Design', 'Design', 'Craft', 'Crafting',
      ];

      $compulsory = ['Mathematics', 'English', 'Native Language'];

      $classes = Klass::where('id', '>', 1)->get();
      $teachers = User::role('Teacher')->get();

      foreach ($compulsory as $name) {
        for ($i = 0; $i < count($classes); $i++) {
          Subjects::create([
            'name' => $name,
            'class_id' => $classes[$i]->id,
            'teacher_id' => $teachers->random()->id,
          ]);
        }
      }

      foreach ($names as $name) {
        Subjects::create([
          'name' => $name,
          'class_id' => $classes->random()->id,
          'teacher_id' => $teachers->random()->id,
        ]);
      }
    }
}
