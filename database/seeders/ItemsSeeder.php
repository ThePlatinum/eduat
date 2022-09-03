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
