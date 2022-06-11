<?php

namespace Database\Seeders;

use App\Models\Items;
use Database\Factories\ItemsFactory;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $items = [
      [
        'name' => 'Uniform',
        'description' => 'School Uniform for all classes',
        'price' => 2500,
        'class_for' => null
      ],
      [
        'name' => 'Cardigan',
        'description' => 'School customized cardigan/sweeter',
        'price' => 1500,
        'class_for' => null
      ],
      [
        'name' => 'Mathematics Textbook 1',
        'description' => 'McMilian Mathematics Textbook for JSS 1',
        'price' => 1300,
        'class_for' => ["2"]
      ],
      [
        'name' => 'English Book 1',
        'description' => 'Jss 1 English Textbook',
        'price' => 900,
        'class_for' => ["2"]
      ],
      [
        'name' => 'Evolutory Biology',
        'description' => 'Evolutary Biology Textbook by Dele Odule',
        'price' => 2300,
        'class_for' => ["5"]
      ],
      [
        'name' => 'Mathematics for Junior Class 2',
        'description' => 'Essential Mathematics Textbook for JSS 2',
        'price' => 1800,
        'class_for' => ["3"]
      ],
      [
        'name' => 'Comprehensive English',
        'description' => 'English Grammar, and Vocabulary Texts for Junior classes',
        'price' => 900,
        'class_for' => ["2","3","4"]
      ],
      [
        'name' => 'Art of Reading',
        'description' => 'Art of Reading, a detailed guide to reading beyond the basics',
        'price' => 1200,
        'class_for' => ["6"]
      ]
    ];

    foreach ($items as $item) {
      Items::create([
        'name' => $item['name'],
        'description' => $item['description'],
        'price' => $item['price'],
        'class_for' => $item['class_for']
      ]);
    }

  }
}
